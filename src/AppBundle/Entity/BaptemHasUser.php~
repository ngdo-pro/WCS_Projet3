<?php

namespace AppBundle\Entity;

/**
 * BaptemHasUser
 */
class BaptemHasUser
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
     * @return BaptemHasUser
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
     * @var \AppBundle\Entity\Baptem
     */
    private $baptem;


    /**
     * Set baptem
     *
     * @param \AppBundle\Entity\Baptem $baptem
     *
     * @return BaptemHasUser
     */
    public function setBaptem(\AppBundle\Entity\Baptem $baptem = null)
    {
        $this->baptem = $baptem;

        return $this;
    }

    /**
     * Get baptem
     *
     * @return \AppBundle\Entity\Baptem
     */
    public function getBaptem()
    {
        return $this->baptem;
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
     * @return BaptemHasUser
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
