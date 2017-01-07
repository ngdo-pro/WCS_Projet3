<?php

namespace AppBundle\Entity;

/**
 * Baptem
 */
class Baptem
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
     * @return Baptem
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
     * @return Baptem
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
     * @return Baptem
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
     * @return Baptem
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
     * @return Baptem
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
    private $baptemsHasUser;


    /**
     * Add baptemsHasUser
     *
     * @param \AppBundle\Entity\BaptemHasUser $baptemsHasUser
     *
     * @return Baptem
     */
    public function addBaptemsHasUser(\AppBundle\Entity\BaptemHasUser $baptemsHasUser)
    {
        $this->baptemsHasUser[] = $baptemsHasUser;

        return $this;
    }

    /**
     * Remove baptemsHasUser
     *
     * @param \AppBundle\Entity\BaptemHasUser $baptemsHasUser
     */
    public function removeBaptemsHasUser(\AppBundle\Entity\BaptemHasUser $baptemsHasUser)
    {
        $this->baptemsHasUser->removeElement($baptemsHasUser);
    }

    /**
     * Get baptemsHasUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBaptemsHasUser()
    {
        return $this->baptemsHasUser;
    }
}
