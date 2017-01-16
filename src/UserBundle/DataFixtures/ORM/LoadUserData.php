<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 05/01/17
 * Time: 11:06
 */

namespace AppBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use UserBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $users = array(
            array(
                "username" => "jean-michel@email.com",
                "usernameCanonical" => "jean-michel@email.com",
                "email"  => "jean-michel@email.com",
                "emailCanonical" => "jean-michel@email.com",
                "enabled" => true,
                "password" => "test",
                "lastLogin" => new \DateTime(),
                "confirmationToken" => "oiengeoingaeongaerg",
                "passwordRequestedAt" => new \DateTime(),
                "roles" => array("ROLE_USER"),
                "civility" => 'm',
                "firstName" => "jean-michel",
                "lastName" => "dupont",
                "slug" => "1-jean-michel-dupont",
                "birthDate" => new \DateTime("1990-06-30"),
                "address" => "23 rue du Poireau",
                "zipCode" => "69006",
                "city" => "Lyon",
                "rating" => 3.4,
                "mobilePhone" => "06-07-15-75-26",
                "level" => 4,
                "participation" => 12
            ),
            array(
                "username" => "john@email.com",
                "usernameCanonical" => "john@email.com",
                "email"  => "john@email.com",
                "emailCanonical" => "john@email.com",
                "enabled" => true,
                "password" => "test",
                "lastLogin" => new \DateTime(),
                "confirmationToken" => "oiengeoingaeazegaerg",
                "passwordRequestedAt" => new \DateTime(),
                "roles" => array("ROLE_USER"),
                "civility" => TRUE,
                "firstName" => "john",
                "lastName" => "mitchell",
                "slug" => "2-john-mitchell",
                "birthDate" => new \DateTime("1990-06-30"),
                "address" => "72 avenue des carottes",
                "zipCode" => "69009",
                "city" => "Lyon",
                "rating" => 2.1,
                "mobilePhone" => "07-45-15-75-26",
                "level" => 4,
                "participation" => 3,
            )
        );
        foreach($users as $user){
            $userObj = new User();
            $userObj->setUsername($user["username"]);
            $userObj->setUsernameCanonical($user["usernameCanonical"]);
            $userObj->setEmail($user["email"]);
            $userObj->setEmailCanonical($user["emailCanonical"]);
            $userObj->setEnabled($user["enabled"]);
            $userObj->setPlainPassword($user["password"]);
            $userObj->setLastLogin($user["lastLogin"]);
            $userObj->setConfirmationToken($user["confirmationToken"]);
            $userObj->setPasswordRequestedAt($user["passwordRequestedAt"]);
            $userObj->setRoles($user["roles"]);
            $userObj->setCivility($user["civility"]);
            $userObj->setFirstName($user["firstName"]);
            $userObj->setLastName($user["lastName"]);
            $userObj->setSlug($user["slug"]);
            $userObj->setBirthDate($user["birthDate"]);
            $userObj->setAddress($user["address"]);
            $userObj->setZipCode($user["zipCode"]);
            $userObj->setCity($user["city"]);
            $userObj->setRating($user["rating"]);
            $userObj->setMobilePhone($user["mobilePhone"]);
            $userObj->setLevel($user["level"]);
            $manager->persist($userObj);
            $this->addReference("user-" . $userObj->getSlug(), $userObj);
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
        return 2;
    }
}