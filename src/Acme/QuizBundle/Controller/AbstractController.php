<?php

namespace Acme\QuizBundle\Controller;

use Doctrine\DBAL\Driver\DrizzlePDOMySql\Connection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Class AbstractController
 * @package Acme\QuizBundle\Controller
 */
class AbstractController extends Controller {
    /**
     * @return EntityManager
     */
    public function getEm() {
        return $this->getDoctrine()->getManager();
    }

    /**
     * @param string $class
     * @return EntityRepository
     */
    public function getRepository($class) {
        return $this->getEm()->getRepository($class);
    }
}