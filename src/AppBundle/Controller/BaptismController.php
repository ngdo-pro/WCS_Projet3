<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Baptism;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Baptism controller.
 *
 */
class BaptismController extends Controller
{
    /**
     * Lists all baptism entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $baptisms = $em->getRepository('AppBundle:Baptism')->findAll();

        return $this->render('baptism/index.html.twig', array(
            'baptisms' => $baptisms,
        ));
    }

    /**
     * Creates a new baptism entity.
     *
     */
    public function newAction(Request $request)
    {
        $baptism = new Baptism();
        $form = $this->createForm('AppBundle\Form\BaptismType', $baptism);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($baptism);
            $em->flush($baptism);

            return $this->redirectToRoute('baptism_info_show', array('id' => $baptism->getId()));
        }

        return $this->render('baptism/new.html.twig', array(
            'baptism' => $baptism,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a baptism entity.
     *
     */
    public function showAction(Baptism $baptism)
    {
        $deleteForm = $this->createDeleteForm($baptism);

        return $this->render('baptism/show.html.twig', array(
            'baptism' => $baptism,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing baptism entity.
     *
     */
    public function editAction(Request $request, Baptism $baptism)
    {
        $deleteForm = $this->createDeleteForm($baptism);
        $editForm = $this->createForm('AppBundle\Form\BaptismType', $baptism);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('baptism_info_edit', array('id' => $baptism->getId()));
        }

        return $this->render('baptism/edit.html.twig', array(
            'baptism' => $baptism,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a baptism entity.
     *
     */
    public function deleteAction(Request $request, Baptism $baptism)
    {
        $form = $this->createDeleteForm($baptism);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($baptism);
            $em->flush($baptism);
        }

        return $this->redirectToRoute('baptism_info_index');
    }

    /**
     * Creates a form to delete a baptism entity.
     *
     * @param Baptism $baptism The baptism entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Baptism $baptism)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('baptism_info_delete', array('id' => $baptism->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function SelectAction(Request $request)
    {
        $baptism = new Baptism();
        $editForm = $this->createForm('AppBundle\Form\BaptismType', $baptism);
        $em = $this->getDoctrine()->getManager();

        $baptisms = $em->getRepository('AppBundle:Baptism')->findAll();

        return $this->render('baptism/select.html.twig', array(
            'baptisms' => $baptisms,
            'edit_form' => $editForm->createView(),
        ));

    }

    /**
     * Finds and displays a baptism entity.
     *
     */
    public function purchaseAction(Request $request)
    {
        //$deleteForm = $this->createDeleteForm($baptism);
        $baptism = new Baptism();

        return $this->render('baptism/show.html.twig', array(
            'baptism' => $baptism,
            //'delete_form' => $deleteForm->createView(),
        ));
    }
}
