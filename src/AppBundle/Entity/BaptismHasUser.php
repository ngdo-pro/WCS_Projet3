<?php

namespace AppBundle\Entity;

/**
 * BaptismHasUser
 */
class BaptismHasUser
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var bool
     */
    private $role;


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
     * Set role
     *
     * @param boolean $role
     *
     * @return BaptismHasUser
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return bool
     */
    public function getRole()
    {
        return $this->role;
    }
    /**
     * @var \AppBundle\Entity\Baptism
     */
    private $baptism;


    /**
     * Set baptism
     *
     * @param \AppBundle\Entity\Baptism $baptism
     *
     * @return BaptismHasUser
     */
    public function setBaptism(\AppBundle\Entity\Baptism $baptism = null)
    {
        $this->baptism = $baptism;

        return $this;
    }

    /**
     * Get baptism
     *
     * @return \AppBundle\Entity\Baptism
     */
    public function getBaptism()
    {
        return $this->baptism;
    }
    /**
     * @var \UserBundle\Entity\User
     */
    private $user;


    /**
     * Set user
     *
     * @param \UserBundle\Entity\User $user
     *
     * @return BaptismHasUser
     */
    public function setUser(\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    /**
     * @var \AppBundle\Entity\Payment
     */
    private $payments;


    /**
     * Set payments
     *
     * @param \AppBundle\Entity\Payment $payments
     *
     * @return BaptismHasUser
     */
    public function setPayments(\AppBundle\Entity\Payment $payments = null)
    {
        $this->payments = $payments;

        return $this;
    }

    /**
     * Get payments
     *
     * @return \AppBundle\Entity\Payment
     */
    public function getPayments()
    {
        return $this->payments;
    }
    /**
     * @var \AppBundle\Entity\Payment
     */
    private $payment;


    /**
     * Set payment
     *
     * @param \AppBundle\Entity\Payment $payment
     *
     * @return BaptismHasUser
     */
    public function setPayment(\AppBundle\Entity\Payment $payment = null)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return \AppBundle\Entity\Payment
     */
    public function getPayment()
    {
        return $this->payment;
    }
}
