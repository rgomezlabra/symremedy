<?php

namespace Us\SymremedyBundle\Entity\Device;
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
     * @ORM\ManyToOne(targetEntity="Us\SymremedyBundle\Entity\Container\Container")
     * @ORM\JoinColumn(name="container_id", referencedColumnName="id")
     */
    protected $container;
    /**
     * @ORM\ManyToOne(targetEntity="Category")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;
    /**
     * @ORM\ManyToOne(targetEntity="Status")
     * @ORM\JoinColumn(name="status_id", referencedColumnName="id")
     */
    protected $status;
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
     * @param \Us\SymremedyBundle\Entity\Container\Container $container
     *
     * @return Device
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
     * Set category
     *
     * @param \Us\SymremedyBundle\Entity\Device\Category $category
     *
     * @return Device
     */
    public function setCategory(\Us\SymremedyBundle\Entity\Device\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \Us\SymremedyBundle\Entity\Device\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set status
     *
     * @param \Us\SymremedyBundle\Entity\Device\Status $status
     *
     * @return Device
     */
    public function setStatus(\Us\SymremedyBundle\Entity\Device\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Us\SymremedyBundle\Entity\Device\Status
     */
    public function getStatus()
    {
        return $this->status;
    }
}
