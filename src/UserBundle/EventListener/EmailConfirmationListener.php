<?php

namespace UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\EventDispatcher\ContainerAwareEventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class EmailConfirmationListener implements EventSubscriberInterface
{
    /**
     * @var ContainerInterface
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

        /** @var $user \FOS\UserBundle\Model\UserInterface */
        $user = $event->getForm()->getData();
        $slug = $this->container->get('user.new_user_slug');
        $userslug = $slug->setNewUserSlug($user->getFirstName(), $user->getLastName());
        $user->setSlug($userslug);

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