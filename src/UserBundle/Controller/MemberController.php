<?php

namespace UserBundle\Controller;

use AppBundle\Entity\BaptismHasUser;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use UserBundle\Entity\User;
use UserBundle\Form\ProfileType;
use AppBundle\Entity\Media;

class MemberController extends Controller
{
    public function orderAction()
    {
        $error = false;
        $user = $this->getUser();
        if (null == $user) {
            Throw $this->createAccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();
        $ordersBaptised = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($user, true);
        $resGuest = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($user, false);
        return $this->render('user/member/my_orders.html.twig', array(
            'ordersBaptised' => $ordersBaptised,
            'resGuest' => $resGuest
        ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * Edit Profile Action
     * TODO validation.xml is not functionnal on this form, find a solution !!!
     */
    public function editAction(Request $request)
    {
        $error = true;
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();

        // Check if the user is connected
        if (!is_object($user) || !$user instanceof UserInterface) {
            Throw $this->createAccessDeniedException('This user does not have access to this section.');
        }
        // Initialize the dispatcher for event call
        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $this->get('event_dispatcher');

        // Create the ProfileType form
        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request)->isValid();

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var  $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            // The event UserListener it's call
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);


            if ($request->files->get('app_user_profile')['media'] != null) {
                /** @var UploadedFile $file */
                $file = $request->files->get('app_user_profile')['media'];

                if ($file->guessExtension() == 'jpg' || $file->guessExtension() == 'jpeg' || $file->guessExtension() == 'png') {

                    if ($user->getMedia() == null) {
                        $media = new Media();
                    } else {
                        $media = $user->getMedia();
                    }

                    $fileName = md5(uniqid()) . '.' . $file->guessExtension();

                    $file->move(
                        $this->getParameter('users_avatar_directory'),
                        $fileName
                    );
                    $media->setName($fileName);

                    if ($media->getCreatedAt() == null) {
                        $media->setCreatedAt(new \DateTime());
                    }

                    $media->setLastUpdatedAt(new \DateTime());
                    $media->setContext('user');
                    $media->setType('img');
                    $media->setUser($user);

                    $em->persist($media);
                    $em->flush($media);
                    $error = false;
                }
            }
        }
        if ($error == true) {
            $error = 'fos_user.media.type';
        }

        return $this->render('user/member/profile_edit.html.twig', array(
            'form' => $form->createView(),
            'error' => $error,
        ));

    }
}