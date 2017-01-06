<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 05/01/17
 * Time: 11:40
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\BaptemHasUser;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadBaptemHasUserData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $baptemHasUsers = array(
            array(
                "role" => true,
                "baptemId" => "1",
                "userSlug" => "jean-michel-dupont",
            )
        );

        foreach ($baptemHasUsers as $baptemHasUser){
            $baptemHasUserObject = new BaptemHasUser();
            $baptemHasUserObject->setRole($baptemHasUser["role"]);
            $baptemHasUserObject->setBaptem($this->getReference("baptem-".$baptemHasUser["baptemId"]));
            $baptemHasUserObject->setUser($this->getReference($baptemHasUser["userSlug"]));
            $manager->persist($baptemHasUserObject);
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
        return 4;
    }
}