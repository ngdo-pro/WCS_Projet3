<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 05/01/17
 * Time: 07:52
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Service;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadServiceData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $services = array(
            array(
                "name" => "midi"
            ),
            array(
                "name" => "soir"
            )
        );

        foreach($services as $service){
            $serviceObject = new Service();
            $serviceObject->setName($service["name"]);
            $manager->persist($serviceObject);
            $this->addReference('service-'.$service["name"], $serviceObject);
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
        return 1;
    }
}