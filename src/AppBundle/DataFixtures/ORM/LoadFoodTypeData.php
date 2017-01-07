<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/01/17
 * Time: 11:12
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\FoodType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadFoodTypeData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $foodTypes = array(
            array(
                "name" => "disruptive"
            ),
            array(
                "name" => "italienne"
            )
        );

        foreach ($foodTypes as $foodType){
            $foodTypeObj = new FoodType();
            $foodTypeObj->setName($foodType["name"]);
            $manager->persist($foodTypeObj);
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
        return 13;
    }
}