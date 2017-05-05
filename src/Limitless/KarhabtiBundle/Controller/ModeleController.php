<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\Modele;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Modele controller.
 *
 */
class ModeleController extends Controller
{
    /**
     * Lists all modele entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $modeles = $em->getRepository('LimitlessKarhabtiBundle:Modele')->findAll();

        return $this->render('modele/index.html.twig', array(
            'modeles' => $modeles,
        ));
    }


    /**
     * Creates a new modele entity.
     *
     */
    public function newAction(Request $request)
    {
        $modele = new Modele();
        $form = $this->createForm('Limitless\KarhabtiBundle\Form\ModeleType', $modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($modele);
            $em->flush($modele);

            return $this->redirectToRoute('superadmin_modele_show', array('id' => $modele->getId()));
        }

        return $this->render('modele/new.html.twig', array(
            'modele' => $modele,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a modele entity.
     *
     */
    public function showAction(Modele $modele)
    {
        $deleteForm = $this->createDeleteForm($modele);

        return $this->render('modele/show.html.twig', array(
            'modele' => $modele,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing modele entity.
     *
     */
    public function editAction(Request $request, Modele $modele)
    {
        $deleteForm = $this->createDeleteForm($modele);
        $editForm = $this->createForm('Limitless\KarhabtiBundle\Form\ModeleType', $modele);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('superadmin_modele_edit', array('id' => $modele->getId()));
        }

        return $this->render('modele/edit.html.twig', array(
            'modele' => $modele,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a modele entity.
     *
     */
    public function deleteAction(Request $request, Modele $modele)
    {
        $form = $this->createDeleteForm($modele);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($modele);
            $em->flush($modele);
        }

        return $this->redirectToRoute('superadmin_modele_index');
    }

    /**
     * Creates a form to delete a modele entity.
     *
     * @param Modele $modele The modele entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Modele $modele)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('superadmin_modele_delete', array('id' => $modele->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function mardemodeleAction($marque)
    {
        $em = $this->getDoctrine()->getManager();
        $marque = $em->getRepository('LimitlessKarhabtiBundle:Marque')->findOneBy(array('libelleMa' => $marque));
        $marque = $marque->getId();
        $modele = $em->getRepository('LimitlessKarhabtiBundle:Modele')->findBy(array('marque' => $marque));

        $mod = array();
        $j= count($modele) ;

        for ($i = 0; $i < $j; $i++){
            $mod[$i] = $modele[$i]->getLibelleMo();

        }

        $response = new JsonResponse();
        return $response->setData(array('mod' => $mod)) ;
    }
}
