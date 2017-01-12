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
                    "status"        => $baptism->getPlaces(),
                    "date"          => $baptism->getDate(),
                    "places"        => $baptism->getPlaces(),
                    "service"       => $baptism->getService(),
                    "restaurant"    => $baptism->getRestaurant(),
                    "reference"     => $resultCount
                );
                $resultCount++;
            }
            /**
             * Fake build of the new baptisms
             */
            $service = $em->getRepository("AppBundle:Service")->findOneBy(array("name" => "midi"));
            $restaurant = $em->getRepository("AppBundle:Restaurant")->findOneBy(array("name" => "wild restaurant"));
            $newBaptisms = array();
            for($i = 0; $i < 2; $i++){
                $results[$resultCount] = array(
                    "id"            => 0,
                    "status"        => "open",
                    "date"          => new \DateTime(),
                    "places"        => 2+$i,
                    "service"       => $service,
                    "restaurant"    => $restaurant,
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
     * This is the start of the function use to show where we should have the result of the search
     * for opportunity for a baptism
     * //TODO : replace the findAll function of the repository by a new function of the repository
     * //TODO : to select the right result for the opportunity
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function selectAction(Request $request)
    {
        $session = $request->getSession();
        $baptisms = $session->get('results');

        $requestC = $request->request;
        if ($requestC->get('origin','') === 'select') {
            $baptism = array();
            $baptism['id']              = $requestC->get('id');
            $baptism['date']            = $requestC->get('date');
            $baptism['status']          = $requestC->get('status');
            $baptism['places']          = $requestC->get('places');
            $baptism['restaurant_id']   = $requestC->get('restaurant_id');
            $baptism['service']         = $requestC->get('service_id');

            $session = $request->getSession();
            $session->set('baptism',$baptism);
            return $this->redirectToRoute('baptism_purchase') ;
        }

        return $this->render('baptism/select.html.twig', array(
            'baptisms' => $baptisms,
        ));

    }

    /**
     * This action receive the chosen baptism parameters, and has 2 parts :
     *     - First, it sends to the view the parameters and a form asking for confirmation
     *     - Second, if confirmation is received, it creates pending baptism, pending payment and
     *       baptismHasUser, then, it redirects to sogenactif payment page.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function purchaseAction(Request $request)
    {
        $session = $request->getSession();
        $baptismParams = $session->get('baptism');

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

            if(isset($baptismParams["id"])) {
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
