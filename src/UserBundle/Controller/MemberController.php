<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 18/01/17
 * Time: 05:07
 */

namespace UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class MemberController extends Controller
{
    public function orderAction(Request $request){
        $user = $this->getUser();

        if(null == $user){
            Throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $ordersBaptised = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($user, true);
        $resGuest = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($user, false);

        $form = $this->createFormBuilder()
            ->add('emails', CollectionType::class, array(
                    'entry_type'    => EmailType::class,
                    'allow_add'     => true,
                    'allow_delete'  => true,
                )
            )
            ->add('validate', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);


        if($form->isValid() && $form->isSubmitted()){
            var_dump($form);
        }

        return $this->render('user/member/my_orders.html.twig', array(
            'user'              => $user,
            'ordersBaptised'    => $ordersBaptised,
            'resGuest'          => $resGuest,
            'form'              => $form->createView()
        ));
    }

    public function publicProfileAction(User $user){
        return $this->render('app/main/index.html.twig');
    }
}