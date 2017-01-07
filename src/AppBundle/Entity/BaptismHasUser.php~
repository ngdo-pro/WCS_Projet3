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
}
