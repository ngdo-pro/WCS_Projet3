<?php

namespace BlogBundle\DataFixtures\ORM;


use BlogBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPostData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $posts = array(
            array(
                "title" => "Italian restaurant",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac.",
                "keyword" => "italian",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac.",
                "views" => 7,
                "visibility" => "ok",
                "create_at" => new \DateTime("2017-01-10"),
                "last_update_at" => new \DateTime("2017-01-10"),
                "category_name" => "italian",
                "tag_title" => "pizza"
            ),
            array(
                "title" => "Vegetable cook",
                "description" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac.",
                "keyword" => "vegan",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ac.",
                "views" => 14,
                "visibility" => "ok",
                "create_at" => new \DateTime("2017-01-10"),
                "last_update_at" => new \DateTime("2017-01-10"),
                "category_name" => "vegan",
                "tag_title" => "vegetable",
            )
        );

        foreach($posts as $post){
            $postObject = new Post();
            $postObject->setTitle($post["title"]);
            $postObject->setDescription($post["description"]);
            $postObject->setKeywords($post["keyword"]);
            $postObject->setContent($post["content"]);
            $postObject->setViews($post["views"]);
            $postObject->setVisibility($post["visibility"]);
            $postObject->setCreatedAt($post["create_at"]);
            $postObject->setLastUpdatedAt($post["last_update_at"]);
            $postObject->setCategory($this->getReference($post["category_name"]));
            // many to many fixtures
            $postObject->addTag($this->getReference($post["tag_title"]));
            if(isset($post["reference"])){
                $postObject->addMedia($this->getReference("post-" . $post["reference"]));
            }
            $manager->persist($postObject);
            $this->addReference($post["title"], $postObject);
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
        return 16;
    }
}