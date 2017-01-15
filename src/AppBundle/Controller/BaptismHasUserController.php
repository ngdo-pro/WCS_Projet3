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

class BaptismHasUserController extends Controller
{
    public function reserveAction(BaptismHasUser $baptismHasUser){

        $em = $this->getDoctrine()->getManager();
        $guestCount = $em->getRepository("AppBundle:BaptismHasUser")->findHowManyGuest($baptismHasUser->getBaptism());

        return $this->render('app/baptism_has_user/guest/baptism_guest.html.twig', array(
            'baptism_has_user'  => $baptismHasUser,
            'guestCount'        => $guestCount
        ));

    }
}