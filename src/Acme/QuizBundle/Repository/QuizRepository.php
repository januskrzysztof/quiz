<?php

namespace Acme\QuizBundle\Repository;

use Acme\QuizBundle\Entity\Quiz;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

/**
 * Class QuizRepository
 * @package Acme\QuizBundle\Repository
 */
class QuizRepository extends EntityRepository {
    /**
     * @return null|Quiz
     */
    public function getRandomQuiz() {
        $ids = $this->getAvailableQuizIds();

        return $this->find($ids[rand(0, (count($ids)-1))]);
    }

    /**
     * @return array
     */
    public function getAvailableQuizIds() {
        $result = $this->createQueryBuilder('quiz')
            ->select('quiz.id')
            ->getQuery()
            ->getResult();

        $ids = [];
        foreach ($result as $value) {
            $ids[] = $value['id'];
        }

        return $ids;
    }
}