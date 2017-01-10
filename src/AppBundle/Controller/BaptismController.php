<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 08/01/17
 * Time: 20:30
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Baptism;
use AppBundle\Entity\BaptismHasUser;
use AppBundle\Entity\Payment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class BaptismController extends Controller
{

    public function selectAction(Request $request){
        // TODO: This is a fake function, need to be replaced with the real selectAction
        $form = $this->createFormBuilder()
            ->add("send", SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()){
            /** @var array $baptismParams contains the parameters of the selected baptism */
            $baptism = new Baptism();
            $baptism->setDate(new \DateTime("2017-01-20"));
            $baptism->setPlaces(2);
            $restaurant = $this->getDoctrine()->getManager()->getRepository("AppBundle:Restaurant")->findOneBy(array("name" => "wild restaurant"));
            $baptism->setRestaurant($restaurant);
            $service = $this->getDoctrine()->getManager()->getRepository("AppBundle:Service")->findOneBy(array("name" => "midi"));
            $baptism->setService($service);
            return $this->forward("AppBundle:Baptism:purchase", array("baptism" => $baptism));
        }

        return $this->render('app/baptism/select.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * This action receive the chosen baptism parameters, and has 2 parts :
     *     - First, it sends to the view the parameters and a form asking for confirmation
     *     - Second, if confirmation is received, it creates pending baptism, pending payment and
     *       baptismHasUser, then, it redirects to sogenactif payment page.
     *
     * @param Request $request
     * @param Baptism $baptism
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function purchaseAction(Request $request, Baptism $baptism)
    {
        $form = $this->createFormBuilder()
            ->add("send", SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();

            $baptism->setStatus("pending");
            $em->persist($baptism);

            /** @var User $user */
            $user = $this->getUser();

            /** creation of BaptismHasUser */
            $baptismHasUser = new BaptismHasUser();
            $baptismHasUser->setBaptism($baptism);
            $baptismHasUser->setUser($user);
            $baptismHasUser->setRole(true);
            $em->persist($baptismHasUser);

            $payment = new Payment();
            $payment->setFirstName($user->getFirstName());
            $payment->setLastName($user->getLastName());
            $payment->setProductName("baptism");
            $payment->setStatus("pending");
            $payment->setConfirmationSent(false);
            $payment->setBaptismHasUser($baptismHasUser);
            $payment->setUser($user);
            $em->persist($payment);

            $em->flush();
        }

        return $this->render('app/baptism/purchase.html.twig', array(
            'baptism' => $baptism,
            'form' => $form->createView()
        ));
    }

}