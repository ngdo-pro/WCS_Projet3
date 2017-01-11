<?php
/**
 * Created by PhpStorm.
 * User: nicolas
 * Date: 06/01/17
 * Time: 07:19
 */

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Payment;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadPaymentData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $payments = array(
            array(
                "firstName" => "jean-michel",
                "lastName" => "dupont",
                "productName" => "baptism",
                "status" => "confirmed",
                "confirmationSent" => true,
                "baptismHasUserId" => "jean-michel-dupont1",
                "userSlug" => "jean-michel-dupont",
                "reference" => "1"
            )
        );

        foreach($payments as $payment){
            $paymentObj = new Payment();
            $paymentObj->setFirstName($payment["firstName"]);
            $paymentObj->setLastName($payment["lastName"]);
            $paymentObj->setProductName($payment["productName"]);
            $paymentObj->setStatus($payment["status"]);
            $paymentObj->setConfirmationSent($payment["confirmationSent"]);
            $paymentObj->setBaptismHasUser($this->getReference("baptismHasUser-" . $payment["baptismHasUserId"]));
            $paymentObj->setUser($this->getReference("user-" . $payment["userSlug"]));
            $manager->persist($paymentObj);
            $this->addReference("payment-" . $payment["reference"], $paymentObj);
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
        return 6;
    }
}