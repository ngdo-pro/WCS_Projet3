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
        $gender = $user->getCivility();
        if ($gender == 'm'){
            $user->setCivility(true);
        } else if ($gender == 'f'){
            $user->setCivility(false);
        }
        $user->setUsername($user->getEmail());
        $slug = $this->container->get('user.new_user_slug');
        $userSlug = $slug->setNewUserSlug($user->getFirstName(), $user->getLastName());
        $user->setSlug($userSlug);

    }

    /**
     * Sets the container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     */
    /*public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }*/
}