<?php

namespace BlogBundle\DataFixtures\ORM;


use BlogBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTagData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tags = array(
            array(
                "title" => "aloa",
                "slug" => "aloa",
            ),
            array(
                "title" => "frite",
                "slug" => "frite",
            ),
            array(
                "title" => "cuisine",
                "slug" => "cuisine",
            )
        );

        foreach($tags as $tag){
            $tagObject = new Tag();
            $tagObject->setTitle($tag["title"]);
            $tagObject->setSlug($tag["slug"]);
            $manager->persist($tagObject);
            $this->addReference($tag["title"], $tagObject);
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
        return 15;
    }
}