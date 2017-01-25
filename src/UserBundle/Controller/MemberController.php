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
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MemberController extends Controller
{
    public function orderAction(Request $request)
    {
        $user = $this->getUser();

        if (null == $user) {
            Throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $ordersBaptised = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($user, true);

        $form = $this->createFormBuilder()
            ->add('emails', CollectionType::class, array(
                    'entry_type' => EmailType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                )
            )
            ->add('validate', SubmitType::class, array(
                'label' => 'form.send',
                'translation_domain' => 'FOSUserBundle',
                'attr' => array('class' => 'pull-right')
            ))
            ->getForm();
        $form->handleRequest($request);


        if ($form->isValid() && $form->isSubmitted()) {
            $emails = $form->getData()['emails'];
            foreach ($emails as $email) {
                $message = \Swift_Message::newInstance()
                    ->setSubject('Hello Email')
                    ->setFrom('send@example.com')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView('email/baptism_of_chef_invitation.html.twig'),
                        'text/html'
                    )/*
                     * If you also want to include a plaintext version of the message
                    ->addPart(
                        $this->renderView(
                            'Emails/registration.txt.twig',
                            array('name' => $name)
                        ),
                        'text/plain'
                    )
                    */
                ;
                $this->get('mailer')->send($message);
            }
        }
        $userPicture = null;
        if ($user->getMedia() != null) {
            $userPicture = $user->getMedia()->getName();
        }

        return $this->render('user/member/my_orders.html.twig', array(
            'user' => $user,
            'ordersBaptised' => $ordersBaptised,
            'form' => $form->createView(),
            'avatar' => $userPicture,
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

        // Check the form
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var  $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            // The event UserListener it's call
            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            // Here we check if an image was uploaded or not
            if ($request->files->get('app_user_profile')['media'] != null) {
                /** @var UploadedFile $file */
                $file = $request->files->get('app_user_profile')['media'];

                // We test the image extension, if it's good we continue the process
                if ($file->guessExtension() == 'jpg' || $file->guessExtension() == 'jpeg' || $file->guessExtension() == 'png') {

                    if ($user->getMedia() == null) {
                        $media = new Media();
                    } else {
                        $media = $user->getMedia();
                    }

                    // Here we attribute an unique name on the picture
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
        // Here we get the picture if is in the database for the view
        $userPicture = null;
        if ($user->getMedia() != null) {
            $userPicture = $user->getMedia()->getName();
        }

        return $this->render('user/member/profile_edit.html.twig', array(
            'form' => $form->createView(),
            'error' => $error,
            'avatar' => $userPicture,
        ));
    }


    public function publicProfileAction(User $user)
    {

        $currentUser = $this->getUser();

        if (null == $currentUser) {
            Throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $baptismsWhereUserIsBaptised = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($user, true);
        $baptismsWhereCurrentUserIsGuest = $em->getRepository("AppBundle:BaptismHasUser")->findByUserAndRole($currentUser, false);

        $baptisms = array();

        foreach ($baptismsWhereUserIsBaptised as $baptismWhereUserIsBaptised) {
            $baptismWhereUserIsBaptised['currentUserIsGuest'] = 0;
            /** @var BaptismHasUser $guest */
            foreach ($baptismsWhereCurrentUserIsGuest as $baptismWhereCurrentUserIsGuest) {

                /** @var BaptismHasUser $baptismHasBaptised */
                $baptismHasBaptised = $baptismWhereUserIsBaptised['baptismHasUser'];
                /** @var BaptismHasUser $baptismHasGuest */
                $baptismHasGuest = $baptismWhereCurrentUserIsGuest['baptismHasUser'];

                if ($baptismHasGuest->getBaptism() == $baptismHasBaptised->getBaptism()) {
                    $baptismWhereUserIsBaptised['currentUserIsGuest'] = $baptismHasGuest->getGuestCount();
                }
            }
            $baptisms[] = $baptismWhereUserIsBaptised;
        }
        $userPicture = null;
        if ($user->getMedia() != null) {
            $userPicture = $user->getMedia()->getName();
        }

        return $this->render('user/member/public_profile.html.twig', array(
            'user' => $user,
            'baptisms' => $baptisms,
            'avatar' => $userPicture,
        ));

    }

    public function reservationAction()
    {
        $user = $this->getUser();

        if (null == $user) {
            Throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $guestReservation = $em->getRepository('AppBundle:BaptismHasUser')->findByUserAndRole($user, false);


        $userPicture = null;
        if ($user->getMedia() != null) {
            $userPicture = $user->getMedia()->getName();
        }

        return $this->render('user/member/my_reservation.html.twig', array(
            'user' => $user,
            'reservations' => $guestReservation,
            'avatar' => $userPicture
        ));
    }
}