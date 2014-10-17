<?php

namespace Acme\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use DateTime;

/**
 * Class AnswerQuiz
 * @package Acme\QuizBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="answer_quiz")
 */
class AnswerQuiz {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Acme\QuizBundle\Entity\Quiz")
     * @ORM\JoinColumn(name="quiz_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     *
     * @var Quiz
     */
    protected $quiz;

    /**
     * @ORM\Column(length=255, nullable=false)
     * @Assert\Email()
     *
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(length=255, nullable=false, options={"default": ""})
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $answer = '';

    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    protected $startAt;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     *
     * @var DateTime
     */
    protected $endAt;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return Quiz
     */
    public function getQuiz() {
        return $this->quiz;
    }

    /**
     * @param Quiz $quiz
     */
    public function setQuiz(Quiz $quiz) {
        $this->quiz = $quiz;
    }

    /**
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getAnswer() {
        return $this->answer;
    }

    /**
     * @param string $answer
     */
    public function setAnswer($answer) {
        $this->answer = $answer;
    }

    /**
     * @return DateTime
     */
    public function getStartAt() {
        return $this->startAt;
    }

    /**
     * @param DateTime $startAt
     */
    public function setStartAt(DateTime $startAt) {
        $this->startAt = $startAt;
    }

    /**
     * @return DateTime
     */
    public function getEndAt() {
        return $this->endAt;
    }

    /**
     * @param DateTime $endAt
     */
    public function setEndAt(DateTime $endAt) {
        $this->endAt = $endAt;
    }
}