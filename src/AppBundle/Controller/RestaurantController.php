<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 18/01/17
 * Time: 13:08
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RestaurantController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $restaurants = $em->getRepository(Restaurant::class)->findSixthFirstRestaurants();
        return $this->render('app/restaurant/home.html.twig', array(
            'restaurants' => $restaurants
        ));
    }

    public function showAction(Restaurant $restaurant){
        return $this->render('app/restaurant/restaurant.html.twig');
    }
}