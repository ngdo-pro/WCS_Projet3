<?php

namespace UserBundle\SlugService;

class SlugService
{
    public function slugNb()
    {
        static $slugnb = 0;
        $slugnb++;
        return $slugnb;
    }
}