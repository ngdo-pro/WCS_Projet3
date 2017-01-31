<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 18/01/17
 * Time: 13:08
 */

namespace AppBundle\Controller;

use Ivory\GoogleMap\Controls\MapTypeControl;
use Ivory\GoogleMap\Controls\MapTypeControlStyle;
use Ivory\GoogleMap\Map;
use Ivory\GoogleMapBundle\Entity\Marker;
use Ivory\GoogleMap\Overlays\MarkerImage;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Restaurant;

class RestaurantController extends Controller
{
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $restaurants = $em->getRepository(Restaurant::class)->findSixthFirstRestaurants();

        // For setting the icon for the markers
        $markerImage = new MarkerImage();
        $markerImage->setPrefixJavascriptVariable('marker_image_');
        $markerImage->setUrl($this->container->get('templating.helper.assets')->getUrl('assets/media/img/loc1.png'));
        $markerImage->setScaledSize(40, 40, "px", "px");

        $map = new Map();
        //remove mapTypeControl and streetViewControl
        $map->setMapOptions(array(  'mapTypeControl'    =>false,
                                    'streetViewControl' =>false) );
        $map->setAutoZoom(true);
        // without this Option the size is limited 300px width and 300 px height
        $map->setStylesheetOption('width', '100%');
        $map->setStylesheetOption('height', '100%');

        // place all restaurants shown on the map
        foreach ($restaurants as $restaurant){
            $marker = new Marker();
            $position = $marker->getPosition();
            $latitude = $restaurant->getLatitude();
            $longitude = $restaurant->getLongitude();
            $position->setLatitude($latitude);
            $position->setLongitude($longitude);
            $marker->setIcon($markerImage);
            $map->addMarker($marker);
        };

        return $this->render('app/restaurant/home.html.twig', array(
            'restaurants' => $restaurants,
            'map' => $map,

        ));
    }

    public function showAction(Restaurant $restaurant){

        $markerImage = new MarkerImage();
        $markerImage->setPrefixJavascriptVariable('marker_image_');
        $markerImage->setUrl($this->container->get('templating.helper.assets')->getUrl('assets/media/img/loc1.png'));
        // dead code left for information
        /*       $markerImage->setAnchor(32, 32);
               $markerImage->setOrigin(0, 0);
               $markerImage->setSize(64, 64, "px", "px");*/
        $markerImage->setScaledSize(40, 40, "px", "px");

        $map = new Map();
        //remove mapTypeControl and streetViewControl
        $map->setMapOptions(array(  'mapTypeControl'    =>false,
                                    'streetViewControl' =>false) );
        // without this Option the size is limited 300px width and 300 px height
        $map->setStylesheetOption('width', '100%');
        $map->setStylesheetOption('height', '300px');
        // place the restaurant shown on the map
        $marker = new Marker();
        $position = $marker->getPosition();
        $latitude = $restaurant->getLatitude();
        $longitude = $restaurant->getLongitude();
        $map->setCenter($latitude, $longitude, true);
        $map->setMapOption('zoom', 18);
        $position->setLatitude($latitude);
        $position->setLongitude($longitude);
        $marker->setIcon($markerImage);
        $map->addMarker($marker);


        $media = $restaurant->getMedias();
        return $this->render('app/restaurant/restaurant.html.twig', array(
            'restaurant' => $restaurant,
            'medias'    => $media,
            'map'       => $map
        ));
    }
}