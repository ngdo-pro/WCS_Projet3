<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 15/01/17
 * Time: 16:42
 */

namespace AppBundle\Controller;


use AppBundle\Entity\BaptismHasUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class BaptismHasUserController extends Controller
{
    public function reserveAction(User $user){
        return $this->render('app/baptism_has_user/guest/baptism_guest.html.twig', array(
            'user'      => $user
        ));
    }
}