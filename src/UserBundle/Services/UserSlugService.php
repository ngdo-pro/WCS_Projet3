<?php

namespace UserBundle\Services;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManager;

class UserSlugService
{
    protected $repository;

    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository('UserBundle:User');
    }
    // This function get user values to return an unique slug
    public function setNewUserSlug($firstName, $lastName)
    {
        $id = $this->repository->countUsers();
        $id++;
        $slugify = new Slugify();
        $slug = $slugify->slugify($id.'-'.$firstName.'-'.$lastName);
        return $slug;
    }

}