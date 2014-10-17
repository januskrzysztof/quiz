<?php

namespace Acme\QuizBundle\Controller;

use Acme\QuizBundle\Form\Type\StartButtonType;
use Symfony\Component\Form\SubmitButton;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\DBAL\DBALException;
use Acme\QuizBundle\Entity\Quiz;
use Acme\QuizBundle\Entity\AnswerQuiz;
use Acme\QuizBundle\Form\Type\AnswerQuizType;
use Exception;
use DateTime;

/**
 * Annotation
 */
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class IndexController
 * @package Acme\QuizBundle\Controller
 */
class IndexController extends AbstractController {
    /**
     * @Route("/", name="_quiz_index")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function indexAction(Request $request) {
        $session = $request->getSession();
        $form    = $this->createForm(new StartButtonType());

        if ($session->has('quiz')) {
            return $this->redirect($this->generateUrl('_quiz_form'));
        }

        if ($request->isMethod('post')) {
            if ($form->handleRequest($request)->isValid()) {
                /** @var SubmitButton $startBtn */
                $startBtn = $form->get('start');

                if ($startBtn->isClicked()) {
                    $session->set('startAt', new DateTime());
                    $session->set('quiz', $this->getRepository(Quiz::class)->getRandomQuiz());

                    return $this->redirect($this->generateUrl('_quiz_form'));
                }
            }
        }

        return ['form' => $form->createView()];
    }

    /**
     * @Route("/quiz", name="_quiz_form")
     * @Template()
     *
     * @return array
     */
    public function quizAction(Request $request) {
        /** @var Session $session */
        $session = $request->getSession();
        $quiz    = $session->get('quiz', null);
        if (!$quiz instanceof Quiz) {
            return $this->redirect($this->generateUrl('_quiz_index'));
        }

        $quiz = $this->getEm()->find(Quiz::class, $quiz->getId());
        $form = $this->createForm(new AnswerQuizType($quiz));

        if ($request->isMethod('post')) {
            if ($form->handleRequest($request)->isValid()) {
                $this->getEm()->beginTransaction();
                try {
                    /** @var AnswerQuiz $data */
                    $data = $form->getData();
                    $data->setStartAt($session->get('startAt'));
                    $data->setEndAt(new DateTime());

                    $this->getEm()->persist($data);
                    $this->getEm()->flush($data);
                    $this->getEm()->commit();

                    $session->getFlashBag()->add('success', '');
                    $session->set('answer', $data->getId());

                    return $this->redirect($this->generateUrl('_quiz_success', ['answer' => $data->getId()]));
                } catch (DBALException $ex) {
                    $this->getEm()->rollBack();
                    $session->getFlashBag()->add('error', '');
                } catch (Exception $ex) {
                    var_dump($ex);
                    $session->getFlashBag()->add('error', $ex->getMessage());
                }
            }
        }

        return [
            'quiz' => $quiz,
            'form' => $form->createView()
        ];
    }

    /**
     * @Route(
     *      "/success/{answer}",
     *      name="_quiz_success",
     *      requirements={"id"="\d+"}
     * )
     * @ParamConverter("answer")
     * @Template()
     *
     * @param AnswerQuiz $answer
     * @param Request $request
     * @return array
     */
    public function successAction(AnswerQuiz $answer, Request $request) {
        $session = $request->getSession();

        if ($session->get('answer', null) !== null) {
            if ($answer->getId() === $session->get('answer')) {
                $session->clear();

                return ['answer' => $answer];
            }
        }

        throw $this->createNotFoundException();
    }
}