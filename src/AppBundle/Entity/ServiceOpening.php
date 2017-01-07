<?php

namespace AppBundle\Entity;

/**
 * ServiceOpening
 */
class ServiceOpening
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $monday;

    /**
     * @var int
     */
    private $tuesday;

    /**
     * @var int
     */
    private $wednesday;

    /**
     * @var int
     */
    private $thursday;

    /**
     * @var int
     */
    private $friday;

    /**
     * @var int
     */
    private $saturday;

    /**
     * @var int
     */
    private $sunday;


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
     * Set monday
     *
     * @param integer $monday
     *
     * @return ServiceOpening
     */
    public function setMonday($monday)
    {
        $this->monday = $monday;

        return $this;
    }

    /**
     * Get monday
     *
     * @return int
     */
    public function getMonday()
    {
        return $this->monday;
    }

    /**
     * Set tuesday
     *
     * @param integer $tuesday
     *
     * @return ServiceOpening
     */
    public function setTuesday($tuesday)
    {
        $this->tuesday = $tuesday;

        return $this;
    }

    /**
     * Get tuesday
     *
     * @return int
     */
    public function getTuesday()
    {
        return $this->tuesday;
    }

    /**
     * Set wednesday
     *
     * @param integer $wednesday
     *
     * @return ServiceOpening
     */
    public function setWednesday($wednesday)
    {
        $this->wednesday = $wednesday;

        return $this;
    }

    /**
     * Get wednesday
     *
     * @return int
     */
    public function getWednesday()
    {
        return $this->wednesday;
    }

    /**
     * Set thursday
     *
     * @param integer $thursday
     *
     * @return ServiceOpening
     */
    public function setThursday($thursday)
    {
        $this->thursday = $thursday;

        return $this;
    }

    /**
     * Get thursday
     *
     * @return int
     */
    public function getThursday()
    {
        return $this->thursday;
    }

    /**
     * Set friday
     *
     * @param integer $friday
     *
     * @return ServiceOpening
     */
    public function setFriday($friday)
    {
        $this->friday = $friday;

        return $this;
    }

    /**
     * Get friday
     *
     * @return int
     */
    public function getFriday()
    {
        return $this->friday;
    }

    /**
     * Set saturday
     *
     * @param integer $saturday
     *
     * @return ServiceOpening
     */
    public function setSaturday($saturday)
    {
        $this->saturday = $saturday;

        return $this;
    }

    /**
     * Get saturday
     *
     * @return int
     */
    public function getSaturday()
    {
        return $this->saturday;
    }

    /**
     * Set sunday
     *
     * @param int $sunday
     *
     * @return ServiceOpening
     */
    public function setSunday($sunday)
    {
        $this->sunday = $sunday;

        return $this;
    }

    /**
     * Get sunday
     *
     * @return int
     */
    public function getSunday()
    {
        return $this->sunday;
    }
    /**
     * @var \AppBundle\Entity\Service
     */
    private $service;


    /**
     * Set service
     *
     * @param \AppBundle\Entity\Service $service
     *
     * @return ServiceOpening
     */
    public function setService(\AppBundle\Entity\Service $service = null)
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get service
     *
     * @return \AppBundle\Entity\Service
     */
    public function getService()
    {
        return $this->service;
    }
    /**
     * @var \AppBundle\Entity\Restaurant
     */
    private $restaurant;


    /**
     * Set restaurant
     *
     * @param \AppBundle\Entity\Restaurant $restaurant
     *
     * @return ServiceOpening
     */
    public function setRestaurant(\AppBundle\Entity\Restaurant $restaurant = null)
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * Get restaurant
     *
     * @return \AppBundle\Entity\Restaurant
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }
}
