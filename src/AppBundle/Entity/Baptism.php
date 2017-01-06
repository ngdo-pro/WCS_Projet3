<?php

namespace AppBundle\Entity;

/**
 * Baptism
 */
class Baptism
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $status;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var int
     */
    private $places;


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
     * Set status
     *
     * @param boolean $status
     *
     * @return Baptism
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Baptism
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set places
     *
     * @param integer $places
     *
     * @return Baptism
     */
    public function setPlaces($places)
    {
        $this->places = $places;

        return $this;
    }

    /**
     * Get places
     *
     * @return int
     */
    public function getPlaces()
    {
        return $this->places;
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
     * @return Baptism
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
     * @var \Doctrine\Common\Collections\Collection
     */
    private $payments;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->payments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add payment
     *
     * @param \AppBundle\Entity\Payment $payment
     *
     * @return Baptism
     */
    public function addPayment(\AppBundle\Entity\Payment $payment)
    {
        $this->payments[] = $payment;

        return $this;
    }

    /**
     * Remove payment
     *
     * @param \AppBundle\Entity\Payment $payment
     */
    public function removePayment(\AppBundle\Entity\Payment $payment)
    {
        $this->payments->removeElement($payment);
    }

    /**
     * Get payments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPayments()
    {
        return $this->payments;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $baptismsHasUser;


    /**
     * Add baptismsHasUser
     *
     * @param \AppBundle\Entity\BaptismHasUser $baptismsHasUser
     *
     * @return Baptism
     */
    public function addBaptismsHasUser(\AppBundle\Entity\BaptismHasUser $baptismsHasUser)
    {
        $this->baptismsHasUser[] = $baptismsHasUser;

        return $this;
    }

    /**
     * Remove baptismsHasUser
     *
     * @param \AppBundle\Entity\BaptismHasUser $baptismsHasUser
     */
    public function removeBaptismsHasUser(\AppBundle\Entity\BaptismHasUser $baptismsHasUser)
    {
        $this->baptismsHasUser->removeElement($baptismsHasUser);
    }

    /**
     * Get baptismsHasUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBaptismsHasUser()
    {
        return $this->baptismsHasUser;
    }
}
