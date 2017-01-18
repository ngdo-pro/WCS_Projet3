<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 18/01/17
 * Time: 05:07
 */

namespace UserBundle\Controller;


use AppBundle\Entity\BaptismHasUser;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class MemberController extends Controller
{
    public function orderAction(){
        $user = $this->getUser();

        if(null == $user){
            Throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $ordersBaptised = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($user, true);
        $resGuest = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($user, false);

        return $this->render('user/member/my_orders.html.twig', array(
            'ordersBaptised'    => $ordersBaptised,
            'resGuest'          => $resGuest
        ));
    }

    public function publicProfileAction(User $user){
        return $this->render('app/main/index.html.twig');
    }
}