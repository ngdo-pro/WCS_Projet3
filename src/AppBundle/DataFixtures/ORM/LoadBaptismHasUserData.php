<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 05/01/17
 * Time: 11:40
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\BaptismHasUser;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBaptismHasUserData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $baptismHasUsers = array(
            array(
                "role" => true,
                "guestCount" => 0,
                "baptismId" => "1",
                "userSlug" => "1-jean-michel-dupont",
                "reference" => "1"
            )
        );

        foreach ($baptismHasUsers as $baptismHasUser){
            $baptismHasUserObject = new BaptismHasUser();
            $baptismHasUserObject->setRole($baptismHasUser["role"]);
            $baptismHasUserObject->setGuestCount($baptismHasUser["guestCount"]);
            $baptismHasUserObject->setBaptism($this->getReference("baptism-".$baptismHasUser["baptismId"]));
            $baptismHasUserObject->setUser($this->getReference("user-" . $baptismHasUser["userSlug"]));
            $manager->persist($baptismHasUserObject);
            $this->addReference("baptismHasUser-" . $baptismHasUser["reference"], $baptismHasUserObject);
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
        return 5;
    }
}