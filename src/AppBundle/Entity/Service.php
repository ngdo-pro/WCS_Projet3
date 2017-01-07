<?php

namespace AppBundle\Entity;

/**
 * Service
 */
class Service
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;


    /**
     * Get id
     *
     * @return int
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
     * @return Service
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $baptisms;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->baptisms = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add baptism
     *
     * @param \AppBundle\Entity\Baptism $baptism
     *
     * @return Service
     */
    public function addBaptism(\AppBundle\Entity\Baptism $baptism)
    {
        $this->baptisms[] = $baptism;

        return $this;
    }

    /**
     * Remove baptism
     *
     * @param \AppBundle\Entity\Baptism $baptism
     */
    public function removeBaptism(\AppBundle\Entity\Baptism $baptism)
    {
        $this->baptisms->removeElement($baptism);
    }

    /**
     * Get baptisms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBaptisms()
    {
        return $this->baptisms;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $serviceOpenings;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $serviceOpeningExceptions;


    /**
     * Add serviceOpening
     *
     * @param \AppBundle\Entity\ServiceOpening $serviceOpening
     *
     * @return Service
     */
    public function addServiceOpening(\AppBundle\Entity\ServiceOpening $serviceOpening)
    {
        $this->serviceOpenings[] = $serviceOpening;

        return $this;
    }

    /**
     * Remove serviceOpening
     *
     * @param \AppBundle\Entity\ServiceOpening $serviceOpening
     */
    public function removeServiceOpening(\AppBundle\Entity\ServiceOpening $serviceOpening)
    {
        $this->serviceOpenings->removeElement($serviceOpening);
    }

    /**
     * Get serviceOpenings
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServiceOpenings()
    {
        return $this->serviceOpenings;
    }

    /**
     * Add serviceOpeningException
     *
     * @param \AppBundle\Entity\ServiceOpeningException $serviceOpeningException
     *
     * @return Service
     */
    public function addServiceOpeningException(\AppBundle\Entity\ServiceOpeningException $serviceOpeningException)
    {
        $this->serviceOpeningExceptions[] = $serviceOpeningException;

        return $this;
    }

    /**
     * Remove serviceOpeningException
     *
     * @param \AppBundle\Entity\ServiceOpeningException $serviceOpeningException
     */
    public function removeServiceOpeningException(\AppBundle\Entity\ServiceOpeningException $serviceOpeningException)
    {
        $this->serviceOpeningExceptions->removeElement($serviceOpeningException);
    }

    /**
     * Get serviceOpeningExceptions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getServiceOpeningExceptions()
    {
        return $this->serviceOpeningExceptions;
    }
}
