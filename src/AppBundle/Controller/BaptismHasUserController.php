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
use Symfony\Component\HttpFoundation\Request;

class BaptismHasUserController extends Controller
{
    public function reserveAction(Request $request, BaptismHasUser $baptismHasUser){

        $em = $this->getDoctrine()->getManager();
        $guestCount = $em->getRepository("AppBundle:BaptismHasUser")->findHowManyGuest($baptismHasUser->getBaptism());
        if(!null == $this->getUser()) {
            $currentUserRole = $em
                ->getRepository("AppBundle:BaptismHasUser")
                ->findIfUserIsParticipating(
                    $baptismHasUser->getBaptism(),
                    $this->getUser()
                );
        }else{
            $currentUserRole = 'none';
        }

        $baptismHasGuest = new BaptismHasUser();
        $form = $this->createForm('AppBundle\Form\BaptismGuestType', $baptismHasGuest);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $baptismHasGuest->setBaptism($baptismHasUser->getBaptism());
            $baptismHasGuest->setUser($this->getUser());
            $baptismHasGuest->setRole(false);
            $em->persist($baptismHasGuest);
            $em->flush();

            return $this->redirect($this->generateUrl('baptism_guest', array('id' => $baptismHasUser->getId())));
        }

        return $this->render('app/baptism_has_user/guest/baptism_guest.html.twig', array(
            'baptism_has_user'  => $baptismHasUser,
            'guestCount'        => $guestCount,
            'currentUserRole'   => $currentUserRole,
            'form'              =>$form->createView()
        ));

    }
}