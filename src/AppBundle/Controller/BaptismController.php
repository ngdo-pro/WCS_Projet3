<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Baptism;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


/**
 * Baptism controller.
 *
 */
class BaptismController extends Controller
{

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

        $requestC = $request->request;
        $em = $this->getDoctrine()->getManager();
        if ($requestC->get('origin','')=='select') {
            $baptism = array();
            $baptism['id'] = $requestC->get('id');
            $baptism['date'] = $requestC->get('date');
            $baptism['status'] = $requestC->get('status');
            $baptism['places'] = $requestC->get('places');
            $baptism['restaurant_id']=$requestC->get('restaurant_id');
            $baptism['service']=$requestC->get('service_id');

            $session = $request->getSession();
            $session->set('baptism',$baptism);
            return $this->redirectToRoute('baptism_purchase') ;
        }


        $baptisms = $em->getRepository('AppBundle:Baptism')->findAll();

        return $this->render('baptism/select.html.twig', array(
            'baptisms' => $baptisms,
        ));

    }

    /**
     * //TODO : This is a fake function, need to be replaced with the real one
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function purchaseAction(Request $request)
    {
        $session = $request->getSession();
        $baptismArray = $session->get('baptism');
        $baptism = new Baptism();

        return $this->render('baptism/show.html.twig', array(
            'baptism' => $baptism,
        ));
    }
}
