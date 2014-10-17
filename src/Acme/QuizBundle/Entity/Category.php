<?php

namespace Acme\QuizBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package Acme\QuizBundle\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="categories")
 */
class Category {
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(length=255)
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Acme\QuizBundle\Entity\Category", inversedBy="children", cascade={"all"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true, onDelete="SET NULL")
     *
     * @var
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Acme\QuizBundle\Entity\Category", mappedBy="parent", cascade={"all"})
     *
     * @var Category[]
     */
    protected $children;

    public function __construct() {
        $this->children = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent(Category $parent = null) {
        $this->parent = $parent;
    }

    /**
     * @return mixed
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * @param Category $category
     */
    public function addChildren(Category $category) {
        $category->setParent($this);
        $this->children[] = $category;
    }
}