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
                "salt" => "aozihzeoinoeuibrgpiae",
                "password" => "test",
                "lastLogin" => new \DateTime(),
                "confirmationToken" => "oiengeoingaeongaerg",
                "passwordRequestedAt" => new \DateTime(),
                "roles" => array("ROLE_USER"),
                "firstName" => "jean-michel",
                "lastName" => "dupont",
                "slug" => "jean-michel-dupont",
                "birthDate" => new \DateTime("1990-06-30"),
                "biography" => "lorem ipsum",
                "signatureDish" => "quiche lorraine",
                "rating" => 3.4,
                "phone" => "06-07-15-75-26",
                "level" => 4,
                "participation" => 12,
                "profession" => "webdev"
            )
        );
        foreach($users as $user){
            $userObj = new User();
            $userObj->setUsername($user["username"]);
            $userObj->setUsernameCanonical($user["usernameCanonical"]);
            $userObj->setEmail($user["email"]);
            $userObj->setEmailCanonical($user["emailCanonical"]);
            $userObj->setEnabled($user["enabled"]);
            $userObj->setSalt($user["salt"]);
            $userObj->setPassword($user["password"]);
            $userObj->setLastLogin($user["lastLogin"]);
            $userObj->setConfirmationToken($user["confirmationToken"]);
            $userObj->setPasswordRequestedAt($user["passwordRequestedAt"]);
            $userObj->setRoles($user["roles"]);
            $userObj->setFirstName($user["firstName"]);
            $userObj->setLastName($user["lastName"]);
            $userObj->setSlug($user["slug"]);
            $userObj->setBirthDate($user["birthDate"]);
            $userObj->setBiography($user["biography"]);
            $userObj->setSignatureDish($user["signatureDish"]);
            $userObj->setRating($user["rating"]);
            $userObj->setPhone($user["phone"]);
            $userObj->setLevel($user["level"]);
            $userObj->setParticipation($user["participation"]);
            $userObj->setProfession($user["profession"]);
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