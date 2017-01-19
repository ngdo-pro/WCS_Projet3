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
            $emails = $form->getData()['emails'];
            foreach ($emails as $email){
                $message = \Swift_Message::newInstance()
                    ->setSubject('Hello Email')
                    ->setFrom('send@example.com')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView('email/baptism_of_chef_invitation.html.twig'),
                        'text/html'
                    )
                    /*
                     * If you also want to include a plaintext version of the message
                    ->addPart(
                        $this->renderView(
                            'Emails/registration.txt.twig',
                            array('name' => $name)
                        ),
                        'text/plain'
                    )
                    */
                ;
                $this->get('mailer')->send($message);
            }
        }

        return $this->render('user/member/my_orders.html.twig', array(
            'user'              => $user,
            'ordersBaptised'    => $ordersBaptised,
            'form'              => $form->createView()
        ));
    }

    public function publicProfileAction(User $user){

        $currentUser = $this->getUser();

        if(null == $currentUser){
            Throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $baptismsWhereUserIsBaptised = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($user, true);
        $baptismsWhereCurrentUserIsGuest = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($currentUser, false);

        $baptisms = array();

        foreach ($baptismsWhereUserIsBaptised as $baptismWhereUserIsBaptised){
            /** @var BaptismHasUser $guest */
            foreach ($baptismsWhereCurrentUserIsGuest as $baptismWhereCurrentUserIsGuest){
                /** @var BaptismHasUser $baptismHasBaptised */
                $baptismHasBaptised = $baptismWhereUserIsBaptised['baptismHasUser'];
                /** @var BaptismHasUser $baptismHasGuest */
                $baptismHasGuest = $baptismWhereCurrentUserIsGuest['baptismHasUser'];
                if($baptismHasGuest->getBaptism() == $baptismHasBaptised->getBaptism()){
                    $baptismWhereUserIsBaptised['userIsGuest'] = true;
                }else{
                    $baptismWhereUserIsBaptised['userIsGuest'] = false;
                }
            }
            $baptisms[] = $baptismWhereUserIsBaptised;
        }

        return $this->render('user/member/public_profile.html.twig', array(
            'user'      => $user,
            'baptisms'  => $baptisms
        ));
    }
}