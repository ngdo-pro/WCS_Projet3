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
    private $baptems;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->baptems = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add baptem
     *
     * @param \AppBundle\Entity\Baptem $baptem
     *
     * @return Service
     */
    public function addBaptem(\AppBundle\Entity\Baptem $baptem)
    {
        $this->baptems[] = $baptem;

        return $this;
    }

    /**
     * Remove baptem
     *
     * @param \AppBundle\Entity\Baptem $baptem
     */
    public function removeBaptem(\AppBundle\Entity\Baptem $baptem)
    {
        $this->baptems->removeElement($baptem);
    }

    /**
     * Get baptems
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBaptems()
    {
        return $this->baptems;
    }
}
