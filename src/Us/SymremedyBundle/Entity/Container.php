<?php

namespace Us\SymremedyBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Us\SymremedyBundle\Entity\Repository\ContainerRepository")
 * @ORM\Table(name="container")
 */
Class Container {
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;
    /**
     * @ORM\Column(name="description", type="text")
     */
    protected $description;
    /**
     * @ORM\Column(name="capacity", type="integer", options={"unsigned":true, "default":0})
     */
    protected $capacity = 0;
    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;
    /**
     * @ORM\OneToMany(targetEntity="Container", mappedBy="parent")
     */
    protected $children;
    /**
     * @ORM\ManyToOne(targetEntity="Container", inversedBy="children")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parent;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Container
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Container
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return Container
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return integer
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set category
     *
     * @param \Us\SymremedyBundle\Entity\Category $category
     *
     * @return Container
     */
    public function setCategory(\Us\SymremedyBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Us\SymremedyBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add child
     *
     * @param \Us\SymremedyBundle\Entity\Container $child
     *
     * @return Container
     */
    public function addChild(\Us\SymremedyBundle\Entity\Container $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \Us\SymremedyBundle\Entity\Container $child
     */
    public function removeChild(\Us\SymremedyBundle\Entity\Container $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \Us\SymremedyBundle\Entity\Container $parent
     *
     * @return Container
     */
    public function setParent(\Us\SymremedyBundle\Entity\Container $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Us\SymremedyBundle\Entity\Container
     */
    public function getParent()
    {
        return $this->parent;
    }
}
