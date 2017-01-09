<?php

namespace AppBundle\Entity;

/**
 * Payment
 */
class Payment
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * @var string
     */
    private $productName;

    /**
     * @var string
     */
    private $status;

    /**
     * @var bool
     */
    private $confirmationSent;


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
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Payment
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Payment
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set productName
     *
     * @param string $productName
     *
     * @return Payment
     */
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get productName
     *
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Payment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set confirmationSent
     *
     * @param boolean $confirmationSent
     *
     * @return Payment
     */
    public function setConfirmationSent($confirmationSent)
    {
        $this->confirmationSent = $confirmationSent;

        return $this;
    }

    /**
     * Get confirmationSent
     *
     * @return bool
     */
    public function getConfirmationSent()
    {
        return $this->confirmationSent;
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
     * @return Payment
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
     * @return Payment
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
     * @var \AppBundle\Entity\BaptismHasUser
     */
    private $baptism_has_user;


    /**
     * Set baptismHasUser
     *
     * @param \AppBundle\Entity\BaptismHasUser $baptismHasUser
     *
     * @return Payment
     */
    public function setBaptismHasUser(\AppBundle\Entity\BaptismHasUser $baptismHasUser = null)
    {
        $this->baptism_has_user = $baptismHasUser;

        return $this;
    }

    /**
     * Get baptismHasUser
     *
     * @return \AppBundle\Entity\BaptismHasUser
     */
    public function getBaptismHasUser()
    {
        return $this->baptism_has_user;
    }
}
