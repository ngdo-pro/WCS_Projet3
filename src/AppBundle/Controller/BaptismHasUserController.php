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
    /**
     * This function gets guests count from a baptism, check if user is a baptised/guest/none and create a form
     * to pass to the view for becoming guest.
     *
     * @param Request $request
     * @param BaptismHasUser $baptismHasUser
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function reserveAction(Request $request, BaptismHasUser $baptismHasUser){

        $em = $this->getDoctrine()->getManager();
        $guestCount = $em->getRepository("AppBundle:BaptismHasUser")->findHowManyGuest($baptismHasUser->getBaptism());

        /** Checks if User is authenticated. If he is, gets his role, else, give him "none" role */
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

        /** Create a form to pass to view, in order to register new guest(s) */
        $baptismHasGuest = new BaptismHasUser();
        $form = $this->createForm('AppBundle\Form\BaptismGuestType', $baptismHasGuest);
        $form->handleRequest($request);

        /** If form is valid, hydrate $baptismHasGuest and persist it */
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