<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 18/01/17
 * Time: 16:49
 */

namespace AppBundle\Entity;


class BaptismSearch
{
    protected $city;

    protected $restaurant;

    protected $nb;

    protected $baptismDate;

    protected $service;

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    /**
     * @param mixed $restaurant
     */
    public function setRestaurant($restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * @return mixed
     */
    public function getNb()
    {
        return $this->nb;
    }

    /**
     * @param mixed $nb
     */
    public function setNb($nb)
    {
        $this->nb = $nb;
    }

    /**
     * @return mixed
     */
    public function getBaptismDate()
    {
        return $this->baptismDate;
    }

    /**
     * @param mixed $baptismDate
     */
    public function setBaptismDate($baptismDate)
    {
        $this->baptismDate = $baptismDate;
    }

    /**
     * @return mixed
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * @param mixed $service
     */
    public function setService($service)
    {
        $this->service = $service;
    }

}