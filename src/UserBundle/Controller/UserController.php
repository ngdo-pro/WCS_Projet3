<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function userIdAction()
    {
        $em = $this->getDoctrine()->getManager()->getRepository('UserBundle:User');
        $userId = $em->findIdByEmail();
        return $userId->getContent();
    }
}