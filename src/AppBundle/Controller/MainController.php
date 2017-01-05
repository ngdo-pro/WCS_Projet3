<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\BaptismSearchType;

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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function  baptismAction()
    {
        return $this->render('app/main/baptism.html.twig',array(
            'baptismSearchType' => $this->createForm(new BaptismSearchType())->createView(),
        ));
    }
}
