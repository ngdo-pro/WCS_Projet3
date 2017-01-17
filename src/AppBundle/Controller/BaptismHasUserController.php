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
            $baptismHasCurrentUser = $em
                ->getRepository("AppBundle:BaptismHasUser")
                ->findIfUserIsParticipating(
                    $baptismHasUser->getBaptism(),
                    $this->getUser()
                );
        }else{
            $baptismHasCurrentUser['role'] = 'none';
        }

        /** Create a form to pass to view, in order to register new guest(s) */
        if($baptismHasCurrentUser['role'] == 'none'){
            $baptismNewGuest = new BaptismHasUser();
            $form = $this->createForm('AppBundle\Form\BaptismGuestType', $baptismNewGuest);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                /** If form is valid, hydrate $baptismNewGuest and persist it */
                $baptismNewGuest->setBaptism($baptismHasUser->getBaptism());
                $baptismNewGuest->setUser($this->getUser());
                $baptismNewGuest->setRole(false);
                $em->persist($baptismNewGuest);
                $em->flush();

                return $this->redirect($this->generateUrl('baptism_guest', array('id' => $baptismHasUser->getId())));
            }
        }else{
            /** @var BaptismHasUser $baptismHasGuest */
            $baptismHasGuest = $baptismHasCurrentUser['baptismHasUser'];
            $form = $this->createForm('AppBundle\Form\BaptismHasGuestType', $baptismHasGuest);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $invitedGuests = $request->request->get('appbundle_baptismhasuser')['invitedGuest'];
                $removedGuests = $baptismHasGuest->getGuestCount();
                if($invitedGuests - $removedGuests != 0){
                    $baptismHasGuest->setGuestCount($invitedGuests - $removedGuests);
                    $em->persist($baptismHasGuest);
                }else{
                    $em->remove($baptismHasGuest);
                }

                $em->flush();

                return $this->redirect($this->generateUrl('baptism_guest', array('id' => $baptismHasUser->getId())));
            }
        }

        return $this->render('app/baptism_has_user/guest/baptism_guest.html.twig', array(
            'baptism_has_user'          => $baptismHasUser,
            'guestCount'                => $guestCount,
            'baptism_has_current_user'  => $baptismHasCurrentUser,
            'form'                      => $form->createView()
        ));

    }
}