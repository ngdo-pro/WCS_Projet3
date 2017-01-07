<?php

namespace BlogBundle\DataFixtures\ORM;


use BlogBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $categorys = array(
            array(
                "name" => "western",
                "slug" => "heu"
            ),
            array(
                "name" => "pokemon",
                "slug" => "what ?"
            )
        );

        foreach($categorys as $category){
            $categoryObject = new Category();
            $categoryObject->setName($category["name"]);
            $categoryObject->setSlug($category["slug"]);
            $manager->persist($categoryObject);
            $this->addReference($category["name"], $categoryObject);
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
        return 14;
    }
}