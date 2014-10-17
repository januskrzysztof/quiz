<?php

namespace Acme\QuizBundle\Form\Type;

use Acme\QuizBundle\Entity\AnswerQuiz;
use Acme\QuizBundle\Entity\Quiz;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class AnswerQuizType
 * @package Acme\QuizBundle\Form\Type
 */
class AnswerQuizType extends AbstractType {
    /**
     * @var Quiz
     */
    private $quiz;

    /**
     * @param Quiz $quiz
     */
    public function __construct(Quiz $quiz) {
        $this->quiz = $quiz;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add(
            'answer',
            $this->quiz->getType(),
            array_merge(
                $this->quiz->getOptions(),
                [
                    'trim'     => true,
                    'required' => false,
                    'label'    => 'your_answer'
                ]
            )
        );

        $builder->add(
            'email',
            'email',
            [
                'label' => 'put_email_address',
                'attr'  => [
                    'placeholder' => 'email'
                ]
            ]
        );

        $builder->add(
            'policy',
            'checkbox',
            [
                'mapped'   => false,
                'required' => true,
                'label'    => 'quiz_policy'
            ]
        );

        $builder->addEventListener(FormEvents::POST_SUBMIT, function (FormEvent $event) {
            /** @var AnswerQuiz $data */
            $data = $event->getData();

            if ($data->getQuiz() === null) {
                $data->setQuiz($this->quiz);
            }
        });
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(['data_class' => AnswerQuiz::class]);
    }


    /**
     * @return string The name of this type
     */
    public function getName() {
        return 'quiz';
    }
}