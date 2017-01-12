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
use AppBundle\Entity\Price;
use AppBundle\Entity\Restaurant;
use AppBundle\Entity\Service;
use SogenactifBundle\Entity\Transaction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class BaptismController extends Controller
{

    public function searchAction(Request $request){
        //TODO: This is a fake action, it needs to be replaced with the real searchAction
        $form = $this->createFormBuilder()
            ->add("send", SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            /**
             * fake result building
             */
            $results = array();
            $resultCount = 0;
            $em = $this->getDoctrine()->getManager();
            $baptisms = $em->getRepository("AppBundle:Baptism")->findAll();
            foreach($baptisms as $baptism){
                $results[$resultCount] = array(
                    "id"            => $baptism->getId(),
                    "status"        => $baptism->getStatus(),
                    "date"          => $baptism->getDate(),
                    "places"        => $baptism->getPlaces(),
                    "serviceName"   => $baptism->getService()->getName(),
                    "restaurantName"=> $baptism->getRestaurant()->getName(),
                    "reference"     => $resultCount
                );
                $resultCount++;
            }
            /**
             * Fake build of the new baptisms
             */
            $service = $em->getRepository("AppBundle:Service")->findBy(array("name" => "midi"));
            $restaurant = $em->getRepository("AppBundle:Restaurant")->findBy(array("name" => "wild restaurant"));
            for($i = 0; $i < 2; $i++){
                $results[$resultCount] = array(
                    "id"            => 0,
                    "status"        => "open",
                    "date"          => new \DateTime(),
                    "places"        => 2+$i,
                    "serviceName"   => $service[0]->getName(),
                    "restaurantName"=> $restaurant[0]->getName(),
                    "reference"     => $resultCount
                );
                $resultCount++;
            }

            $session = $request->getSession();
            $session->set('results', $results);
            return $this->redirectToRoute('baptism_select');
        }

        return $this->render('app/baptism/search.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * Here we display results to the User and he can choose his baptism
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function selectAction(Request $request)
    {
        $session = $request->getSession();
        $baptisms = $session->get('results');
        return $this->render('baptism/select.html.twig', array(
            'baptisms' => $baptisms,
        ));

    }

    /**
     * This action receive the chosen baptism reference and create the baptism parameters
     * After that, there is 2 parts :
     *     - First, it sends to the view the parameters and a form asking for confirmation
     *     - Second, if confirmation is received, it creates pending baptism, pending payment and
     *       baptismHasUser, then, it redirects to sogenactif payment page.
     *
     * @param Request $request
     * @param $reference
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function purchaseAction(Request $request, $reference)
    {
        $session = $request->getSession();
        $result = $session->get('results');

        $baptismParams = $result[$reference];

        $form = $this->createFormBuilder()
            ->add("send", SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $this->getDoctrine()->getManager();

            $restaurant = $em->getRepository("AppBundle:Restaurant")->findOneBy(array("name" => $baptismParams["restaurantName"]));
            $service = $em->getRepository("AppBundle:Service")->findOneBy(array("name" => $baptismParams["serviceName"]));
            /** @var User $user */
            $user = $this->getUser();

            if(0 === $baptismParams["id"]) {
                $baptism = new Baptism();
            }else{
                $baptism = $em->getRepository("AppBundle:Baptism")->find($baptismParams["id"]);
            }
            $baptism->setRestaurant($restaurant);
            $baptism->setService($service);
            $baptism->setStatus($baptismParams["status"]);
            $baptism->setDate($baptismParams["date"]);
            $baptism->setPlaces($baptismParams["places"]-1);

            $em->persist($baptism);

            $baptismHasUser = new BaptismHasUser();
            $baptismHasUser->setBaptism($baptism);
            $baptismHasUser->setUser($user);
            $baptismHasUser->setRole(true);
            $em->persist($baptismHasUser);

            $prices = $em->getRepository("AppBundle:Price")->findByProduct("bapteme");
            /** @var Price $price */
            $price = $prices[0];

            $transaction = new Transaction();
            $transaction->setAmount($price->getValue() * 100);
            $transaction->setCreated(new \DateTime());
            $transaction->setCurrencyCode(978);
            $transaction->setCustomerEmail($user->getEmail());
            $transaction->setCustomerId($user->getId());
            $em->persist($transaction);

            $payment = new Payment();
            $payment->setFirstName($user->getFirstName());
            $payment->setLastName($user->getLastName());
            $payment->setProductName("baptism");
            $payment->setStatus("pending");
            $payment->setConfirmationSent(false);
            $payment->setBaptismHasUser($baptismHasUser);
            $payment->setUser($user);
            $payment->setTransaction($transaction);
            $em->persist($payment);

            $em->flush();
            $em->clear();

            $session->set('transaction', $transaction);
            return $this->redirectToRoute("sogenactif_sending");
        }

        return $this->render('app/baptism/purchase.html.twig', array(
            'baptism' => $baptismParams,
            'form' => $form->createView()
        ));
    }

}
