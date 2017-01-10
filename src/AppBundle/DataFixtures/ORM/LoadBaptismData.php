<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 05/01/17
 * Time: 07:52
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Baptism;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBaptismData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $baptisms = array(
            array(
                "status" => "open",
                "date" => new \DateTime("2017-01-10"),
                "places" => 2,
                "service" => "midi",
                "restaurantSlug" => "wild-restaurant",
                "reference" => "1"
            ),
            array(
                "status" => "open",
                "date" => new \DateTime("2017-01-20"),
                "places" => 1,
                "service" => "soir",
                "restaurantSlug" => "wild-restaurant",
                "reference" => "2"
            )
        );

        foreach($baptisms as $baptism){
            $baptismObject = new Baptism();
            $baptismObject->setStatus($baptism["status"]);
            $baptismObject->setDate($baptism["date"]);
            $baptismObject->setPlaces($baptism["places"]);
            $baptismObject->setService($this->getReference("service-" . $baptism["service"]));
            $baptismObject->setRestaurant($this->getReference("restaurant-" . $baptism["restaurantSlug"]));
            $manager->persist($baptismObject);
            $this->addReference("baptism-".$baptism["reference"], $baptismObject);
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
        return 4;
    }
}