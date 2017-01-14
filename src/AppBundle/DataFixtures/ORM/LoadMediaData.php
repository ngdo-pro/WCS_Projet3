<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/01/17
 * Time: 07:42
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Media;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMediaData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $medias = array(
            array(
                "name" => "jean-michel d.jpg",
                "createdAt" => new \DateTime(),
                "lastUpdatedAt" => new \DateTime(),
                "context" => "user",
                "type" => "img",
                "userSlug" => "1-jean-michel-dupont"
            ),
            array(
                "name" => "wild first floor",
                "createdAt" => new \DateTime(),
                "lastUpdatedAt" => new \DateTime(),
                "context" => "restaurant",
                "type" => "img",
                "restaurantSlug" => "wild-restaurant"
            ),
            array(
                "name" => "middle west",
                "createdAt" => new \DateTime(),
                "lastUpdatedAt" => new \DateTime(),
                "context" => "cook",
                "type" => "img",
                "postSlug" => "middle-cook"
            )
        );

        foreach ($medias as $media){
            $mediaObj = new Media();
            $mediaObj->setName($media["name"]);
            $mediaObj->setCreatedAt($media["createdAt"]);
            $mediaObj->setLastUpdatedAt($media["lastUpdatedAt"]);
            $mediaObj->setContext($media["context"]);
            $mediaObj->setType($media["type"]);
            if(isset($media["restaurantSlug"])){
                $mediaObj->setRestaurant($this->getReference("restaurant-" . $media["restaurantSlug"]));
            }elseif(isset($media["userSlug"])){
                $mediaObj->setUser($this->getReference("user-" . $media["userSlug"]));
            }elseif(isset($media["postSlug"])){
                $this->addReference("post-" . $media["postSlug"], $mediaObj);
            }
            $manager->persist($mediaObj);
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
        return 7;
    }
}