<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/01/17
 * Time: 07:29
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Restaurant;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadRestaurantData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $restaurants = array(
            array(
                "name" => "wild restaurant",
                "description" => "lorem ipsum",
                "openingDate" => new \DateTime("2017-01-06"),
                "address" => "17 rue delandine",
                "status" => "validated",
                "webUrl" => "www.wildcodeschool.fr",
                "tripAdvisorUrl" => "none",
                "facebookUrl" => "none",
                "phone" => "04-05-06-07-08",
                "phone2" => "06-07-08-09-10",
                "email" => "wcs@email.com",
                "slug" => "wild-restaurant",
                "postalCode" => "69002",
                "city" => "lyon",
                "foodType" => "disruptive",
                "userSlug" => "1-jean-michel-dupont",
                "latitude" => "45.7463057",
                "longitude" => "4.8269647",
            ),
            array(
                "name" => "wild fake",
                "description" => "lorem ipsum",
                "openingDate" => new \DateTime("2017-01-06"),
                "address" => "30 cours Suchet",
                "status" => "validated",
                "webUrl" => "www.wildcodeschool.fr",
                "tripAdvisorUrl" => "none",
                "facebookUrl" => "none",
                "phone" => "04-04-04-04-04",
                "phone2" => "06-06-06-06-16",
                "email" => "wcs@email.com",
                "slug" => "wild-fake",
                "postalCode" => "69002",
                "city" => "lyon",
                "foodType" => "unknow",
                "userSlug" => "1-jean-michel-dupont",
                "latitude" => "45.7468179",
                "longitude" => "4.8237256",
            ),
        );

        foreach ($restaurants as $restaurant){
            $restaurantObj = new Restaurant();
            $restaurantObj->setName($restaurant["name"]);
            $restaurantObj->setDescription($restaurant["description"]);
            $restaurantObj->setOpeningDate($restaurant["openingDate"]);
            $restaurantObj->setAddress($restaurant["address"]);
            $restaurantObj->setStatus($restaurant["status"]);
            $restaurantObj->setWebUrl($restaurant["webUrl"]);
            $restaurantObj->setTripAdvisorUrl($restaurant["tripAdvisorUrl"]);
            $restaurantObj->setFacebookUrl($restaurant["facebookUrl"]);
            $restaurantObj->setPhone($restaurant["phone"]);
            $restaurantObj->setPhone2($restaurant["phone2"]);
            $restaurantObj->setEmail($restaurant["email"]);
            $restaurantObj->setSlug($restaurant["slug"]);
            $restaurantObj->setPostalCode($restaurant["postalCode"]);
            $restaurantObj->setCity($restaurant["city"]);
            $restaurantObj->setFoodType($restaurant["foodType"]);
            $restaurantObj->setUser($this->getReference("user-" . $restaurant["userSlug"]));
            $restaurantObj->setLatitude($restaurant['latitude']);
            $restaurantObj->setLongitude($restaurant['longitude']);
            $manager->persist($restaurantObj);
            $this->addReference("restaurant-" . $restaurantObj->getSlug(), $restaurantObj);
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
        return 3;
    }
}