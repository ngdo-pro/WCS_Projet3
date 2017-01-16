<?php

namespace UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use UserBundle\Entity\User;


class UserListener implements EventSubscriberInterface
{
    /**
     * @var ContainerInterface $container
     */
    protected $container;

    /**
     * UserRegistrationListener constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * This function check the registration event
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => array('onRegistrationSuccess',-10),
            FOSUserEvents::PROFILE_EDIT_SUCCESS => array('onProfileEditSuccess',-10),
        );
    }

    /**
     * This function is call when the profile edit event is execute
     * @param FormEvent $event
     */
    public function onProfileEditSuccess(FormEvent $event)
    {
        /** @var $user User */
        $user = $event->getForm()->getData();

        // Here we take a string to set it Uppercase the first character of each word
        $firstName = ucwords(strtolower($user->getFirstName()));
        $user->setFirstName($firstName);

        $lastName = ucwords(strtolower($user->getLastName()));
        $user->setLastName($lastName);

        $city = ucwords(strtolower($user->getCity()));
        $user->setCity($city);

        // Here we normalize the phone number
        $phone = $user->getMobilePhone();
        if (strlen($phone) > 10){
            $phone = preg_replace('/[. ]/', "-", $phone);
            $user->setMobilePhone($phone);
        } else if (strlen($phone) == 10){
            $i = 0;
            $mobile = "";
            while ($i != 10){
                $nb = substr($phone, $i, 2);
                $mobile .= $nb.'-';
                $i = $i + 2;
            }
            $phone = preg_replace('/[-]$/', "", $mobile);
            $user->setMobilePhone($phone);
        }

        // Here we create an user slug with UserSlugService
        $slugUser = $user->getSlug();
        $slug = $this->container->get('user.new_user_slug');
        $userSlug = $slug->setUserSlug($slugUser, $user->getFirstName(), $user->getLastName());
        $user->setSlug($userSlug);
    }

    /**
     * This function is call when the registration event is execute
     * @param FormEvent $event
     */
    public function onRegistrationSuccess(FormEvent $event)
    {

        /** @var $user User */
        $user = $event->getForm()->getData();
        // Here we take a string to set it Uppercase the first character of each word
        $firstName = ucwords(strtolower($user->getFirstName()));
        $user->setFirstName($firstName);

        $lastName = ucwords(strtolower($user->getLastName()));
        $user->setLastName($lastName);

        $city = ucwords(strtolower($user->getCity()));
        $user->setCity($city);

        // Here we set the email value to the username for login with email
        $user->setUsername($user->getEmail());

        // Here we normalize the phone number
        $phone = $user->getMobilePhone();
        if (strlen($phone) > 10){
            $phone = preg_replace('/[. ]/', "-", $phone);
            $user->setMobilePhone($phone);
        } else if (strlen($phone) == 10){
            $i = 0;
            $mobile = "";
            while ($i != 10){
                $nb = substr($phone, $i, 2);
                $mobile .= $nb.'-';
                $i = $i + 2;
            }
            $phone = preg_replace('/[-]$/', "", $mobile);
            $user->setMobilePhone($phone);
        }

        // Here we create an user slug with UserSlugService
        $slug = $this->container->get('user.new_user_slug');
        $userSlug = $slug->setNewUserSlug($user->getFirstName(), $user->getLastName());
        $user->setSlug($userSlug);

    }
}