<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\Avis_agence;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Avis_agence controller.
 *
 */
class Avis_agenceController extends Controller
{
    /**
     * Lists all avis_agence entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $avis_agences = $em->getRepository('LimitlessKarhabtiBundle:Avis_agence')->findAll();

        return $this->render('LimitlessKarhabtiBundle:avis_agence:index.html.twig', array(
            'avis_agences' => $avis_agences,
        ));
    }

    /**
     * Creates a new avis_agence entity.
     *
     */
    public function newAction(Request $request)
    {
        $avis_agence = new Avis_agence();
        $form = $this->createForm('Limitless\KarhabtiBundle\Form\Avis_agenceType', $avis_agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis_agence);
            $em->flush($avis_agence);

            return $this->redirectToRoute('avis_agence_show', array('id' => $avis_agence->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:avis_agence:new.html.twig', array(
            'avis_agence' => $avis_agence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a avis_agence entity.
     *
     */
    public function showAction(Avis_agence $avis_agence)
    {
        $deleteForm = $this->createDeleteForm($avis_agence);

        return $this->render('LimitlessKarhabtiBundle:avis_agence:show.html.twig', array(
            'avis_agence' => $avis_agence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing avis_agence entity.
     *
     */
    public function editAction(Request $request, Avis_agence $avis_agence)
    {
        $deleteForm = $this->createDeleteForm($avis_agence);
        $editForm = $this->createForm('Limitless\KarhabtiBundle\Form\Avis_agenceType', $avis_agence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('avis_agence_edit', array('id' => $avis_agence->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:avis_agence:edit.html.twig', array(
            'avis_agence' => $avis_agence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a avis_agence entity.
     *
     */
    public function deleteAction(Request $request, Avis_agence $avis_agence)
    {
        $form = $this->createDeleteForm($avis_agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($avis_agence);
            $em->flush($avis_agence);
        }

        return $this->redirectToRoute('avis_agence_index');
    }

    /**
     * Creates a form to delete a avis_agence entity.
     *
     * @param Avis_agence $avis_agence The avis_agence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Avis_agence $avis_agence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('avis_agence_delete', array('id' => $avis_agence->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
