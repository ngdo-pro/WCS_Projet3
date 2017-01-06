<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/01/17
 * Time: 10:25
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Price;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPriceData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $prices = array(
            array(
                "value" => 99.99,
                "reference" => "1"
            )
        );

        foreach($prices as $price){
            $priceObj = new Price();
            $priceObj->setValue($price["value"]);
            $manager->persist($priceObj);
            $this->addReference("price-" . $price["reference"], $priceObj);
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
        return 10;
    }
}