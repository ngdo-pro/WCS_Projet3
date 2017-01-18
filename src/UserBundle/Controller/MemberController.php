<?php

namespace UserBundle\Controller;

use AppBundle\Entity\BaptismHasUser;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
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
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        /** @var User $user */
        $user = $this->getUser();


        if (!is_object($user) || !$user instanceof UserInterface) {
            Throw $this->createAccessDeniedException('This user does not have access to this section.');
        }
        /** @var EventDispatcherInterface $dispatcher */
        $dispatcher = $this->get('event_dispatcher');

        $form = $this->createForm(ProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var  $userManager UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($form, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if ($request->files->get('app_user_profile')['media'] != null) {

                if ($user->getMedia() == null) {
                    $media = new Media();
                } else {
                    $media = $user->getMedia();
                }
                /** @var UploadedFile $file */
                $file = $request->files->get('app_user_profile')['media'];
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
            }
        }

        return $this->render('@FOSUser/test.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}