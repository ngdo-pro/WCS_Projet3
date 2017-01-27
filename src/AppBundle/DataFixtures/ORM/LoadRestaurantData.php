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
                "city" => "lyon 2eme",
                "foodType" => "disruptive",
                "userSlug" => "3-chef-cook",
                "latitude" => "45.74627",
                "longitude" => "4.82683",
            ),
            array(
                "name" => "136 avenue",
                "description" => "Le 136 avenue est un restaurant de cuisine française, à base de produits frais de saison. Stéphanie et Fabrice vous accueillent dans un décor moderne et chaleureux, pour un moment gastronomique convivial !",
                "openingDate" => new \DateTime("2017-01-06"),
                "address" => "136 avenue Félix Faure",
                "status" => "validated",
                "webUrl" => "www.wildcodeschool.fr",
                "tripAdvisorUrl" => "none",
                "facebookUrl" => "none",
                "phone" => "04-05-06-07-08",
                "phone2" => "06-07-08-09-10",
                "email" => "wcs@email.com",
                "slug" => "136-avenue",
                "postalCode" => "69003",
                "city" => "lyon 3eme",
                "foodType" => "gastronomique",
                "userSlug" => "3-chef-cook",
                "latitude" => "45.75411",
                "longitude" => "4.86415",
            ),
            array(
                "name" => "arsenic",
                "description" => "Arsenic : un mot aussi fort que notre passion pour la cuisine Parce que nous avons la volonté de secouer avec énergie la cuisine traditionnelle pour lui donner un sens nouveau. Ainsi est né L’Art-scénique ou « La scène des nouveaux chefs ». Ce lieu est un endroit unique où de jeunes chefs vont pouvoir donner libre cours à leur créativité et vous faire découvrir leur vision de la cuisine, épurée, décalée et toute en fraîcheur. Arsenic incarne l'évolution de Chefs, issus de la nouvelle génération et passés par le restaurant étoilé Christian TETEDOIE.",
                "openingDate" => new \DateTime("2017-01-06"),
                "address" => "132 rue Pierre Corneille",
                "status" => "validated",
                "webUrl" => "www.wildcodeschool.fr",
                "tripAdvisorUrl" => "none",
                "facebookUrl" => "none",
                "phone" => "04-05-06-07-08",
                "phone2" => "06-07-08-09-10",
                "email" => "wcs@email.com",
                "slug" => "arsenic",
                "postalCode" => "69003",
                "city" => "lyon 3eme",
                "foodType" => "traditonnelle",
                "userSlug" => "3-chef-cook",
                "latitude" => "45.75917",
                "longitude" => "4.84448",
            ),
            array(
                "name" => "au pré fleuri",
                "description" => "Ouvert très récemment, le pré fleuri assume ses tendances viandesques. La peinture couleur ardoise met en valeur les bibelots bovins déposés çà et là. Une rapide lecture de la carte confirme ce pressentiment : on vient ici pour manger de la viande, et de la bonne : la cuisine se fournit chez Beauvallet, négociant d’Ambérieu-en-Bugey. Stéphane, le patron, met à l’aise tout le monde, pour notre plus grand plaisir !",
                "openingDate" => new \DateTime("2017-01-06"),
                "address" => "123 rue de Sèze",
                "status" => "validated",
                "webUrl" => "www.wildcodeschool.fr",
                "tripAdvisorUrl" => "none",
                "facebookUrl" => "none",
                "phone" => "04-05-06-07-08",
                "phone2" => "06-07-08-09-10",
                "email" => "wcs@email.com",
                "slug" => "au-pre-fleuri",
                "postalCode" => "69006",
                "city" => "lyon 6eme",
                "foodType" => "traditonnelle",
                "userSlug" => "3-chef-cook",
                "latitude" => "45.76907",
                "longitude" => "4.85508",
            ),
            array(
                "name" => "bistrot gustave",
                "description" => "Dans un cadre industriel et convivial, nous vous ferons déguster une cuisine traditionnelle généreuse et un grand éventail de vins de nos régions !",
                "openingDate" => new \DateTime("2017-01-06"),
                "address" => "9, Rue des Marronniers",
                "status" => "validated",
                "webUrl" => "www.wildcodeschool.fr",
                "tripAdvisorUrl" => "none",
                "facebookUrl" => "none",
                "phone" => "04-05-06-07-08",
                "phone2" => "06-07-08-09-10",
                "email" => "wcs@email.com",
                "slug" => "bistrot-gustave",
                "postalCode" => "69002",
                "city" => "lyon 2eme",
                "foodType" => "traditonnelle",
                "userSlug" => "3-chef-cook",
                "latitude" => "45.75696",
                "longitude" => "4.83485",
            ),
            array(
                "name" => "bistrot la varenne",
                "description" => "Situé au cœur de Lyon, dans le quartier des Antiquaires, le Bistrot La Varenne vous accueille pour des moments de détente et de partage. Dans une ambiance authentique et traditionnelle, Jean-Baptiste et son équipe vous feront découvrir ou redécouvrir des produits du terroir de grande qualité. Au menu: cuisine du marché, produits du terroir, planches de dégustation, vins d’exception et petites trouvailles! Passez un bon moment entre amis et laissez-vous guider par l’équipe de La Varenne!",
                "openingDate" => new \DateTime("2017-01-06"),
                "address" => "5, Place Gailleton",
                "status" => "validated",
                "webUrl" => "www.wildcodeschool.fr",
                "tripAdvisorUrl" => "none",
                "facebookUrl" => "none",
                "phone" => "04-05-06-07-08",
                "phone2" => "06-07-08-09-10",
                "email" => "wcs@email.com",
                "slug" => "bistrot-la-varenne",
                "postalCode" => "69002",
                "city" => "lyon 2eme",
                "foodType" => "traditonnelle",
                "userSlug" => "3-chef-cook",
                "latitude" => "45.75323",
                "longitude" => "4.83295",
            ),
            array(
                "name" => "chez augusto",
                "description" => "Situé sur la presqu’île, en plein centre de Lyon, Chez Augusto fait partie de ces adresses qui cultivent fond et forme : cadre épuré et soigné et assiette pour gourmets. La spécialité de la maison ? L’Italie, dans ce qu’elle a de plus gastronomique.",
                "openingDate" => new \DateTime("2017-01-06"),
                "address" => "6 rue Neuve",
                "status" => "validated",
                "webUrl" => "www.wildcodeschool.fr",
                "tripAdvisorUrl" => "none",
                "facebookUrl" => "none",
                "phone" => "04-05-06-07-08",
                "phone2" => "06-07-08-09-10",
                "email" => "wcs@email.com",
                "slug" => "chez-augusto",
                "postalCode" => "69002",
                "city" => "lyon 2eme",
                "foodType" => "gastronomique",
                "userSlug" => "3-chef-cook",
                "latitude" => "45.7651",
                "longitude" => "4.83494",
            ),
            array(
                "name" => "got milk",
                "description" => "Dans un cadre chaleureux et convivial, venez débuter la journée par un café, un chocolat ou un thé d'exception accompagnés de viennoiseries maison. Chaque jour, le chef vous propose une cuisine du marché élaboré à base de produits frais et de saisons. La pause de l'après-midi c'est ici. Venez profiter de notre terrasse intérieure abritée et ensoleillée. Un café, un rafraichissement, une part de tarte maison, et la journée continue. Après une bonne journée de travail, venez évacuer le stress et vous détendre au son des mix de nos DJ. Mojitos, rosé frais, tapas et ardoises apéro... Quoi de mieux pour finir la journée et bien commencer la soirée ?",
                "openingDate" => new \DateTime("2017-01-06"),
                "address" => "42 cours Suchet",
                "status" => "validated",
                "webUrl" => "www.wildcodeschool.fr",
                "tripAdvisorUrl" => "none",
                "facebookUrl" => "none",
                "phone" => "04-05-06-07-08",
                "phone2" => "06-07-08-09-10",
                "email" => "wcs@email.com",
                "slug" => "got-milk",
                "postalCode" => "69002",
                "city" => "lyon 2eme",
                "foodType" => "traditionnelle",
                "userSlug" => "3-chef-cook",
                "latitude" => "45.74617",
                "longitude" => "4.82496",
            ),
            array(
                "name" => "l'épisens",
                "description" => "Situé au cœur de la presqu'île de Lyon, l'Episens vous accueille avec une cuisine moderne et raffinée qui éveillera vos sens !",
                "openingDate" => new \DateTime("2017-01-06"),
                "address" => "6 rue Palais Grillet",
                "status" => "validated",
                "webUrl" => "www.wildcodeschool.fr",
                "tripAdvisorUrl" => "none",
                "facebookUrl" => "none",
                "phone" => "04-05-06-07-08",
                "phone2" => "06-07-08-09-10",
                "email" => "wcs@email.com",
                "slug" => "l-episens",
                "postalCode" => "69002",
                "city" => "lyon 2eme",
                "foodType" => "traditionnelle",
                "userSlug" => "3-chef-cook",
                "latitude" => "45.76312",
                "longitude" => "4.83496",
            )
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