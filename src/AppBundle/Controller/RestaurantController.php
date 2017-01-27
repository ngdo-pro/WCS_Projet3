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
use Ivory\GoogleMapBundle\Twig\GoogleMapExtension;

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
        $map->setStylesheetOption('height', '450px');

        // not working
        /*$styles = array (
            array( "elementType"=> "geometry",
                "stylers"=> array (
                    "color"=> "#f5f5f5"
                )
            ),
            array( "elementType"=> "labels.icon",
                "stylers"=> array (
                    "visibility"=>"off"
                )
            ),
            array( "elementType"=> "labels.text.fill",
                "stylers"=> array (
                    "color"=> "#616161"
                )
            ),
            array( "elementType"=> "labels.text.stroke",
                "stylers"=> array (
                    "color"=> "#f5f5f5"
                )
            ),
            array(
                "featureType" =>"administrative.land_parcel",
                "elementType"=>"labels.text.fill",
                "stylers"=> array (
                    "color"=> "#bdbdbd"
                )
            ),
            array(
                "featureType" =>"poi",
                "elementType"=>"geometry",
                "stylers"=> array (
                    "color"=> "#eeeeee"
                )
            ),
            array(
                "featureType" =>"poi",
                "elementType"=>"labels.text.fill",
                "stylers"=> array (
                    "color"=> "#757575"
                )
            ),
            array(
                "featureType" =>"poi.park",
                "elementType"=>"geometry",
                "stylers"=> array (
                    "color"=> "#e5e5e5"
                )
            ),
            array(
                "featureType" =>"poi.park",
                "elementType"=>"labels.text.fill",
                "stylers"=> array (
                    "color"=> "#9e9e9e"
                )
            ),
            array(
                "featureType" =>"road",
                "elementType"=>"geometry",
                "stylers"=> array (
                    "color"=> "#ffffff"
                )
            ),
            array(
                "featureType" =>"road.arterial",
                "elementType"=>"labels.text.fill",
                "stylers"=> array (
                    "color"=> "#757575"
                )
            ),
            array(
                "featureType" =>"road.highway",
                "elementType"=>"geometry",
                "stylers"=> array (
                    "color"=> "#dadada"
                )
            ),
            array(
                "featureType" =>"road.highway",
                "elementType"=>"labels.text.fill",
                "stylers"=> array (
                    "color"=> "#616161"
                )
            ),
            array(
                "featureType" =>"road.local",
                "elementType"=>"labels.text.fill",
                "stylers"=> array (
                    "color"=> "#9e9e9e"
                )
            ),
            array(
                "featureType"=>"transit.line",
                "elementType"=>"geometry",
                "stylers"=> array (
                    "color"=> "#e5e5e5"
                )
            ),
            array(
                "featureType"=>"transit.station",
                "elementType"=>"geometry",
                "stylers"=> array (
                    "color"=> "#eeeeee"
                )
            ),
            array("featureType"=>"water",
                "elementType"=>"geometry",
                "stylers"=> array (
                    "color"=> "#c9c9c9"
                )
            ),
            array("featureType"=>"water",
                "elementType"=>"labels.text.fill",
                "stylers"=> array (
                    "color"=> "#9e9e9e"
                )
            ),
        );


        $map->setMapOptions(array ("styles"=> $styles)); */

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