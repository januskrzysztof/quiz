<?php

namespace Acme\QuizBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Quiz
 * @package Acme\QuizBundle\Entity
 *
 * @ORM\Entity(repositoryClass="Acme\QuizBundle\Repository\QuizRepository")
 * @ORM\Table(name="quiz")
 */
class Quiz {
    const TYPE_TEXT     = 'text';
    const TYPE_TEXTAREA = 'textarea';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected  $id;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    protected $content;

    /**
     * @ORM\Column(length=255, options={"default": "text"})
     *
     * @var string
     */
    protected $type = self::TYPE_TEXT;

    /**
     * @ORM\Column(type="array")
     *
     * @var array
     */
    protected $options = array();

    /**
     * @ORM\ManyToOne(targetEntity="Acme\QuizBundle\Entity\Category", cascade={"all"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     *
     * @var Category
     */
    protected $category;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * @return string
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options) {
        $this->options = $options;
    }

    /**
     * @return Category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * @param Category $category
     */
    public function setCategory(Category $category = null) {
        $this->category = $category;
    }
}