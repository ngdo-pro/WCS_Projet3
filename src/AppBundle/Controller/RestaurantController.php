<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 18/01/17
 * Time: 13:08
 */

namespace AppBundle\Controller;

use Ivory\GoogleMap\Map;
use Ivory\GoogleMapBundle\Entity\Marker;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ivory\GoogleMap\Base\Bound;
use Ivory\GoogleMap\Base\Coordinate;
use AppBundle\Entity\Restaurant;

class RestaurantController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $restaurants = $em->getRepository(Restaurant::class)->findSixthFirstRestaurants();

        $map = new Map();

        $map->setAutoZoom(true);
        // without this Option the size is limited 300px width and 300 px height
        $map->setStylesheetOption('width', '100%');
        $map->setStylesheetOption('height', '500px');

        foreach ($restaurants as $restaurant){
            $marker = new Marker();
            $position = $marker->getPosition();
            $latitude = $restaurant->getLatitude();
            $longitude = $restaurant->getLongitude();
            $position->setLatitude($latitude);
            $position->setLongitude($longitude);
            $map->addMarker($marker);
        };

        return $this->render('app/restaurant/home.html.twig', array(
            'restaurants' => $restaurants,
            'map' => $map,

        ));
    }

    public function showAction(Restaurant $restaurant){
        return $this->render('app/main/index.html.twig');
    }
}