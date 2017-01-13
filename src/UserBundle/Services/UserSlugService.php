<?php

namespace UserBundle\Services;

use Cocur\Slugify\Slugify;
use UserBundle\Repository\UserRepository;

class UserSlugService
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function setNewUserSlug($email, $firstName, $lastName)
    {
        $id = $this->repository->findIdByEmail($email);
        $id++;
        $slugify = new Slugify();
        $slug = $slugify->slugify($id.'.'.$firstName.'.'.$lastName);
        return $slug;
    }

}