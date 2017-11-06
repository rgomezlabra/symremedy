<?php

namespace Us\SymremedyBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Us\SymremedyBundle\Entity\Repository\DeviceRepository")
 * @ORM\Table(name="device")
 */
Class Device {
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
     * @ORM\ManyToOne(targetEntity="Container")
     * @ORM\JoinColumn(name="container_id", referencedColumnName="id")
     */
    protected $container;
    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;
    /**
     * @ORM\ManyToOne(targetEntity="State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     */
    protected $state;
    /**
     * @ORM\Column(name="acquiredat", type="date")
     */
    protected $acquiredat;
    /**
     * @ORM\Column(name="warrantyend", type="date")
     */
    protected $warrantyend;

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
     * @return Device
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
     * @return Device
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
     * Set acquiredat
     *
     * @param \DateTime $acquiredat
     *
     * @return Device
     */
    public function setAcquiredat($acquiredat)
    {
        $this->acquiredat = $acquiredat;

        return $this;
    }

    /**
     * Get acquiredat
     *
     * @return \DateTime
     */
    public function getAcquiredat()
    {
        return $this->acquiredat;
    }

    /**
     * Set warrantyend
     *
     * @param \DateTime $warrantyend
     *
     * @return Device
     */
    public function setWarrantyend($warrantyend)
    {
        $this->warrantyend = $warrantyend;

        return $this;
    }

    /**
     * Get warrantyend
     *
     * @return \DateTime
     */
    public function getWarrantyend()
    {
        return $this->warrantyend;
    }

    /**
     * Set container
     *
     * @param \Us\SymremedyBundle\Entity\Container $container
     *
     * @return Device
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
     * Set category
     *
     * @param \Us\SymremedyBundle\Entity\Category $category
     *
     * @return Device
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
     * Set state
     *
     * @param \Us\SymremedyBundle\Entity\State $state
     *
     * @return Device
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
