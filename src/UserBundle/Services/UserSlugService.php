<?php

namespace UserBundle\Services;

use Cocur\Slugify\Slugify;
use Doctrine\ORM\EntityManager;
use UserBundle\Repository\UserRepository;

class UserSlugService
{
    protected $repository;

    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository('UserBundle:User');
    }

    public function setNewUserSlug($firstName, $lastName)
    {
        $id = $this->repository->findIdByEmail();
        $id++;
        $slugify = new Slugify();
        $slug = $slugify->slugify($id.'.'.$firstName.'.'.$lastName);
        return $slug;
    }

}