<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 08/01/17
 * Time: 20:30
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class BaptismController extends Controller
{

    public function selectAction(Request $request){
        // TODO: This is a fake function, need to be replaced with the real searchAction
        $form = $this->createFormBuilder()
            ->add("send", SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted()){
            /** @var array $baptismParams contains the parameters of the selected baptism */
            $baptismParams = array(
                "cityId" => 1,
                "serviceId" => 1,
                "restaurantId" => 1,
                "date" => new \DateTime("2017-01-20"),
                "places" => 2
            );
            return $this->forward("AppBundle:Baptism:purchase", array("params" => $baptismParams));
        }

        return $this->render('app/baptism/select.html.twig', array(
            'form' => $form->createView()
        ));
    }

    public function purchaseAction(Request $request, array $params = null)
    {
        $form = $this->createFormBuilder()
            ->add("confirm", SubmitType::class)
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            return $this->forward("");
        }

        return $this->render('app/baptism/purchase.html.twig', array(
            'params' => $params
        ));
    }

}