<?php

namespace Us\SymremedyBundle\Entity\Issue;
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
     * @ORM\ManyToOne(targetEntity="Us\SymremedyBundle\Entity\User\User")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    protected $creator;
    /**
     * @ORM\Column(name="createdat", type="date")
     */
    protected $createdat;
    /**
     * @ORM\ManyToOne(targetEntity="Us\SymremedyBundle\Entity\User\User")
     * @ORM\JoinColumn(name="rsolver_id", referencedColumnName="id")
     */
    protected $rsolver;
    /**
     * @ORM\Column(name="resolvedat", type="date")
     */
    protected $resolvedat;
    /**
     * @ORM\ManyToOne(targetEntity="Us\SymremedyBundle\Entity\Container\Container")
     * @ORM\JoinColumn(name="container_id", referencedColumnName="id")
     */
    protected $container;
    /**
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;


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
     * @param \Us\SymremedyBundle\Entity\User\User $creator
     *
     * @return Issue
     */
    public function setCreator(\Us\SymremedyBundle\Entity\User\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \Us\SymremedyBundle\Entity\User\User
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * Set rsolver
     *
     * @param \Us\SymremedyBundle\Entity\User\User $rsolver
     *
     * @return Issue
     */
    public function setRsolver(\Us\SymremedyBundle\Entity\User\User $rsolver = null)
    {
        $this->rsolver = $rsolver;

        return $this;
    }

    /**
     * Get rsolver
     *
     * @return \Us\SymremedyBundle\Entity\User\User
     */
    public function getRsolver()
    {
        return $this->rsolver;
    }

    /**
     * Set container
     *
     * @param \Us\SymremedyBundle\Entity\Container\Container $container
     *
     * @return Issue
     */
    public function setContainer(\Us\SymremedyBundle\Entity\Container\Container $container = null)
    {
        $this->container = $container;

        return $this;
    }

    /**
     * Get container
     *
     * @return \Us\SymremedyBundle\Entity\Container\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Set status
     *
     * @param \Us\SymremedyBundle\Entity\Issue\Status $status
     *
     * @return Issue
     */
    public function setStatus(\Us\SymremedyBundle\Entity\Issue\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Us\SymremedyBundle\Entity\Issue\Status
     */
    public function getStatus()
    {
        return $this->status;
    }
}
