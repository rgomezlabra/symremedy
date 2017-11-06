<?php

namespace Us\SymremedyBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Us\SymremedyBundle\Entity\Repository\IssueRepository")
 * @ORM\Table(name="issue")
 */
Class Issue {
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @ORM\Column(name="name", type="string", length=50)
     */
    protected $name;
    /**
     * @ORM\Column(name="description", type="text")
     */
    protected $description;
    /**
     * @ORM\Column(name="explanation", type="text")
     */
    protected $explanation;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    protected $creator;
    /**
     * @ORM\Column(name="createdat", type="date")
     */
    protected $createdat;
    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="rsolver_id", referencedColumnName="id")
     */
    protected $rsolver;
    /**
     * @ORM\Column(name="resolvedat", type="date")
     */
    protected $resolvedat;
    /**
     * @ORM\ManyToOne(targetEntity="Container")
     * @ORM\JoinColumn(name="container_id", referencedColumnName="id")
     */
    protected $container;
    /**
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    protected $state;

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
     * @return Issue
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
     * @return Issue
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
     * Set explanation
     *
     * @param string $explanation
     *
     * @return Issue
     */
    public function setExplanation($explanation)
    {
        $this->explanation = $explanation;

        return $this;
    }

    /**
     * Get explanation
     *
     * @return string
     */
    public function getExplanation()
    {
        return $this->explanation;
    }

    /**
     * Set createdat
     *
     * @param \DateTime $createdat
     *
     * @return Issue
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Get createdat
     *
     * @return \DateTime
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Set resolvedat
     *
     * @param \DateTime $resolvedat
     *
     * @return Issue
     */
    public function setResolvedat($resolvedat)
    {
        $this->resolvedat = $resolvedat;

        return $this;
    }

    /**
     * Get resolvedat
     *
     * @return \DateTime
     */
    public function getResolvedat()
    {
        return $this->resolvedat;
    }

    /**
     * Set creator
     *
     * @param \Us\SymremedyBundle\Entity\User $creator
     *
     * @return Issue
     */
    public function setCreator(\Us\SymremedyBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \Us\SymremedyBundle\Entity\User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set rsolver
     *
     * @param \Us\SymremedyBundle\Entity\User $rsolver
     *
     * @return Issue
     */
    public function setRsolver(\Us\SymremedyBundle\Entity\User $rsolver = null)
    {
        $this->rsolver = $rsolver;

        return $this;
    }

    /**
     * Get rsolver
     *
     * @return \Us\SymremedyBundle\Entity\User
     */
    public function getRsolver()
    {
        return $this->rsolver;
    }

    /**
     * Set container
     *
     * @param \Us\SymremedyBundle\Entity\Container $container
     *
     * @return Issue
     */
    public function setContainer(\Us\SymremedyBundle\Entity\Container $container = null)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Get container
     *
     * @return \Us\SymremedyBundle\Entity\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Set state
     *
     * @param \Us\SymremedyBundle\Entity\State $state
     *
     * @return Issue
     */
    public function setState(\Us\SymremedyBundle\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return \Us\SymremedyBundle\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }
}
