<?php

namespace UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use UserBundle\Entity\User;


class EmailConfirmationListener implements EventSubscriberInterface
{
    /**
     * @var ContainerInterface $container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(FormEvent $event)
    {

        /** @var $user User */
        $user = $event->getForm()->getData();
        // Here we take the civility value to return a boolean
        $gender = $user->getCivility();
        if ($gender == 'm'){
            $user->setCivility(true);
        } else if ($gender == 'f'){
            $user->setCivility(false);
        }
        // Here we set the email value to the username for login with email
        $user->setUsername($user->getFirstName());
        // Here we create an user slug with UserSlugService
        $slug = $this->container->get('user.new_user_slug');
        $userSlug = $slug->setNewUserSlug($user->getFirstName(), $user->getLastName());
        $user->setSlug($userSlug);

    }
}