<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/01/17
 * Time: 09:43
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\ServiceOpeningException;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadServiceopeningExceptionData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $serviceOpeningExceptions = array(
            array(
                "date" => new \DateTime("2017-01-30"),
                "status" => 0,
                "service" => "midi",
                "restaurantSlug" => "wild-restaurant"
            ),
            array(
                "date" => new \DateTime("2017-01-31"),
                "status" => 2,
                "service" => "soir",
                "restaurantSlug" => "wild-restaurant"
            )
        );

        foreach($serviceOpeningExceptions as $exception){
            $serviceOpeningExceptionObj = new ServiceOpeningException();
            $serviceOpeningExceptionObj->setDate($exception["date"]);
            $serviceOpeningExceptionObj->setStatus($exception["status"]);
            $serviceOpeningExceptionObj->setService($this->getReference("service-" . $exception["service"]));
            $serviceOpeningExceptionObj->setRestaurant($this->getReference("restaurant-" . $exception["restaurantSlug"]));
            $manager->persist($serviceOpeningExceptionObj);
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
        return 9;
    }
}