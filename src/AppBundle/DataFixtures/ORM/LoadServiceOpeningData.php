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
            ),
            array(
                "monday" => 1,
                "tuesday" => 1,
                "wednesday" => 1,
                "thursday" => 3,
                "friday" => 2,
                "saturday" => 1,
                "sunday" => 0,
                "service" => "midi",
                "restaurantSlug" => "136-avenue"
            ),
            array(
                "monday" => 0,
                "tuesday" => 0,
                "wednesday" => 0,
                "thursday" => 0,
                "friday" => 2,
                "saturday" => 0,
                "sunday" => 1,
                "service" => "soir",
                "restaurantSlug" => "136-avenue"
            ),
            array(
                "monday" => 0,
                "tuesday" => 1,
                "wednesday" => 1,
                "thursday" => 0,
                "friday" => 0,
                "saturday" => 1,
                "sunday" => 0,
                "service" => "midi",
                "restaurantSlug" => "arsenic"
            ),
            array(
                "monday" => 0,
                "tuesday" => 1,
                "wednesday" => 0,
                "thursday" => 1,
                "friday" => 0,
                "saturday" => 0,
                "sunday" => 1,
                "service" => "soir",
                "restaurantSlug" => "arsenic"
            ),
            array(
                "monday" => 1,
                "tuesday" => 1,
                "wednesday" => 1,
                "thursday" => 3,
                "friday" => 2,
                "saturday" => 1,
                "sunday" => 0,
                "service" => "midi",
                "restaurantSlug" => "au-pre-fleuri"
            ),
            array(
                "monday" => 2,
                "tuesday" => 1,
                "wednesday" => 1,
                "thursday" => 1,
                "friday" => 2,
                "saturday" => 0,
                "sunday" => 1,
                "service" => "soir",
                "restaurantSlug" => "au-pre-fleuri"
            ),
            array(
                "monday" => 1,
                "tuesday" => 1,
                "wednesday" => 1,
                "thursday" => 3,
                "friday" => 2,
                "saturday" => 1,
                "sunday" => 0,
                "service" => "midi",
                "restaurantSlug" => "bistrot-gustave"
            ),
            array(
                "monday" => 0,
                "tuesday" => 0,
                "wednesday" => 0,
                "thursday" => 0,
                "friday" => 2,
                "saturday" => 2,
                "sunday" => 1,
                "service" => "soir",
                "restaurantSlug" => "bistrot-gustave"
            ),
            array(
                "monday" => 1,
                "tuesday" => 1,
                "wednesday" => 1,
                "thursday" => 3,
                "friday" => 2,
                "saturday" => 1,
                "sunday" => 0,
                "service" => "midi",
                "restaurantSlug" => "bistrot-la-varenne"
            ),
            array(
                "monday" => 0,
                "tuesday" => 0,
                "wednesday" => 0,
                "thursday" => 0,
                "friday" => 2,
                "saturday" => 0,
                "sunday" => 1,
                "service" => "soir",
                "restaurantSlug" => "bistrot-la-varenne"
            ),
            array(
                "monday" => 1,
                "tuesday" => 1,
                "wednesday" => 1,
                "thursday" => 3,
                "friday" => 2,
                "saturday" => 1,
                "sunday" => 0,
                "service" => "midi",
                "restaurantSlug" => "chez-augusto"
            ),
            array(
                "monday" => 0,
                "tuesday" => 0,
                "wednesday" => 0,
                "thursday" => 0,
                "friday" => 2,
                "saturday" => 0,
                "sunday" => 1,
                "service" => "soir",
                "restaurantSlug" => "chez-augusto"
            ),
            array(
                "monday" => 1,
                "tuesday" => 1,
                "wednesday" => 1,
                "thursday" => 3,
                "friday" => 2,
                "saturday" => 1,
                "sunday" => 0,
                "service" => "midi",
                "restaurantSlug" => "got-milk"
            ),
            array(
                "monday" => 0,
                "tuesday" => 0,
                "wednesday" => 0,
                "thursday" => 0,
                "friday" => 2,
                "saturday" => 0,
                "sunday" => 1,
                "service" => "soir",
                "restaurantSlug" => "got-milk"
            ),
            array(
                "monday" => 1,
                "tuesday" => 1,
                "wednesday" => 1,
                "thursday" => 3,
                "friday" => 2,
                "saturday" => 1,
                "sunday" => 0,
                "service" => "midi",
                "restaurantSlug" => "l-episens"
            ),
            array(
                "monday" => 0,
                "tuesday" => 0,
                "wednesday" => 0,
                "thursday" => 0,
                "friday" => 2,
                "saturday" => 0,
                "sunday" => 1,
                "service" => "soir",
                "restaurantSlug" => "l-episens"
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