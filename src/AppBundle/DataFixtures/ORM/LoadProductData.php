<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/01/17
 * Time: 10:29
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Product;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadProductData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $products = array(
            array(
                "name" => "bapteme",
                "reference" => "1"
            )
        );

        foreach ($products as $product){
            $productObj = new Product();
            $productObj->setName($product["name"]);
            $manager->persist($productObj);
            $this->addReference("product-" . $product["reference"], $productObj);
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