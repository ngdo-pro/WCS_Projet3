<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/01/17
 * Time: 08:50
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\ServiceOpening;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadServiceOpeningData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $serviceOpenings = array(
            array(
                "monday" => 2,
                "tuesday" => 0,
                "wednesday" => 0,
                "thursday" => 1,
                "friday" => 0,
                "saturday" => 0,
                "sunday" => 0,
                "service" => "soir",
                "restaurantSlug" => "wild-restaurant"
            ),
            array(
                "monday" => 1,
                "tuesday" => 1,
                "wednesday" => 0,
                "thursday" => 0,
                "friday" => 2,
                "saturday" => 0,
                "sunday" => 0,
                "service" => "midi",
                "restaurantSlug" => "wild-restaurant"
            )
        );

        foreach($serviceOpenings as $opening){
            $serviceOpeningObj = new ServiceOpening();
            $serviceOpeningObj->setMonday($opening["monday"]);
            $serviceOpeningObj->setTuesday($opening["tuesday"]);
            $serviceOpeningObj->setWednesday($opening["wednesday"]);
            $serviceOpeningObj->setThursday($opening["thursday"]);
            $serviceOpeningObj->setFriday($opening["friday"]);
            $serviceOpeningObj->setSaturday($opening["saturday"]);
            $serviceOpeningObj->setSunday($opening["sunday"]);
            $serviceOpeningObj->setService($this->getReference("service-" . $opening["service"]));
            $serviceOpeningObj->setRestaurant($this->getReference("restaurant-" . $opening["restaurantSlug"]));
            $manager->persist($serviceOpeningObj);
        }

        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 8;
    }
}