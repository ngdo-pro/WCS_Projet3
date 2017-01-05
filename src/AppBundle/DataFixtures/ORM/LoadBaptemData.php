<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 05/01/17
 * Time: 07:52
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Baptem;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBaptemData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $baptems = array(
            array(
                "status" => true,
                "date" => new \DateTime("2017-01-10"),
                "places" => 2,
                "service" => "midi"
            ),
            array(
                "status" => true,
                "date" => new \DateTime("2017-01-20"),
                "places" => 1,
                "service" => "soir"
            )
        );

        foreach($baptems as $baptem){
            $baptemObject = new Baptem();
            $baptemObject->setStatus($baptem["status"]);
            $baptemObject->setDate($baptem["date"]);
            $baptemObject->setPlaces($baptem["places"]);
            $baptemObject->setService($this->getReference("service-".$baptem["service"]));
            $manager->persist($baptemObject);
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
        return 2;
    }
}