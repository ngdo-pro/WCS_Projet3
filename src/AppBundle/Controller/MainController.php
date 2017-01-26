<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\BaptismSearchType;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class MainController
 * @package AppBundle\Controller
 */
class MainController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('app/main/index.html.twig');
    }

    public function estimateAction()
    {
        return $this->render('app/main/estimate.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function  baptismAction(Request $request)
    {
        $test = "rien";
        if (strtolower($request->getMethod()) == 'post') {
            $em = $this->getDoctrine()->getManager();
            $requestC = $request->request->get('app_baptism_search');
            $city = $requestC['city'];
            $restaurant = $requestC['restaurant'];
            if ($restaurant == "") {
                $restaurant = Null;
            }
            $nb = $requestC['nb'];
            $baptismDate = $requestC['baptismDate'];
            $service = $requestC['service'];
            $test = $em->getRepository('AppBundle:Baptism')->findAllFree($city,$restaurant,$nb,$baptismDate,$service);
        };
        return $this->render('app/main/baptism.html.twig',array(
            'selectcase' => $test,
            'baptismSearchType' => $this->createForm(BaptismSearchType::class)->createView(),
        ));
    }
}
