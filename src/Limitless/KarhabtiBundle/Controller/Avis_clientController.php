<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\Avis_client;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Avis_client controller.
 *
 */
class Avis_clientController extends Controller
{
    /**
     * Lists all avis_client entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $avis_clients = $em->getRepository('LimitlessKarhabtiBundle:Avis_client')->findAll();

        return $this->render('LimitlessKarhabtiBundle:avis_client:index.html.twig', array(
            'avis_clients' => $avis_clients,
        ));
    }

    /**
     * Creates a new avis_client entity.
     *
     */
    public function newAction(Request $request)
    {
        $avis_client = new Avis_client();
        $form = $this->createForm('Limitless\KarhabtiBundle\Form\Avis_clientType', $avis_client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($avis_client);
            $em->flush($avis_client);

            return $this->redirectToRoute('avis_client_show', array('id' => $avis_client->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:avis_client:new.html.twig', array(
            'avis_client' => $avis_client,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a avis_client entity.
     *
     */
    public function showAction(Avis_client $avis_client)
    {
        $deleteForm = $this->createDeleteForm($avis_client);

        return $this->render('LimitlessKarhabtiBundle:avis_client:show.html.twig', array(
            'avis_client' => $avis_client,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing avis_client entity.
     *
     */
    public function editAction(Request $request, Avis_client $avis_client)
    {
        $deleteForm = $this->createDeleteForm($avis_client);
        $editForm = $this->createForm('Limitless\KarhabtiBundle\Form\Avis_clientType', $avis_client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('avis_client_edit', array('id' => $avis_client->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:avis_client:edit.html.twig', array(
            'avis_client' => $avis_client,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a avis_client entity.
     *
     */
    public function deleteAction(Request $request, Avis_client $avis_client)
    {
        $form = $this->createDeleteForm($avis_client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($avis_client);
            $em->flush($avis_client);
        }

        return $this->redirectToRoute('avis_client_index');
    }

    /**
     * Creates a form to delete a avis_client entity.
     *
     * @param Avis_client $avis_client The avis_client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Avis_client $avis_client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('avis_client_delete', array('id' => $avis_client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
