<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\ReservationOffre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Limitless\KarhabtiBundle\Entity\Offre;
use Limitless\KarhabtiBundle\Entity\Client;
/**
 * Reservationoffre controller.
 *
 */
class ReservationOffreController extends Controller
{
    /**
     * Lists all reservationOffre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservationOffres = $em->getRepository('LimitlessKarhabtiBundle:ReservationOffre')->findAll();
        $Offres = $em->getRepository('LimitlessKarhabtiBundle:Offre')->findAll();

        return $this->render('LimitlessKarhabtiBundle:reservationoffre:index.html.twig', array(
            'reservationOffres' => $reservationOffres,'Offres'=>$Offres
        ));
    }

    /**
     * Creates a new reservationOffre entity.
     *
     */
    public function newAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=$em->getRepository('LimitlessKarhabtiBundle:Client')->findOneBy(array('user' => $user));
        $err1="";
        $err2="";

        $reservationOffre = new Reservationoffre();

        $offre=$em->getRepository('LimitlessKarhabtiBundle:Offre')->find($id);

        $form = $this->createForm('Limitless\KarhabtiBundle\Form\ReservationOffreType', $reservationOffre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($reservationOffre->getHeureCodeS()<5)
            {
                $err1="le nombre d heures minimum est 5 h";
            }

            elseif ($reservationOffre->getHeureConduiteS()<10)
            {
                $err2="le nombre d heures minimum est 10 h";
            }
            else {
                $em = $this->getDoctrine()->getManager();
                $prixC = $offre->getPrixUcode();
                $prixP = $offre->getPrixUconduite();
                $prixT = ($prixC * $reservationOffre->getHeureCodeS()) + ($prixP * $reservationOffre->getHeureConduiteS());
                $reservationOffre->setOffre($offre);
                $reservationOffre->setPrixTotale($prixT);
                $reservationOffre->setClient($profil);
                $em->persist($reservationOffre);
                $em->flush();
                return $this->redirectToRoute('reservationoffre_show', array('id' => $reservationOffre->getId()));
            }   }

        return $this->render('LimitlessKarhabtiBundle:reservationoffre:new.html.twig', array(
            'client'=>$profil,
            'err1' => $err1,
            'err2' => $err2,
            'reservationOffre' => $reservationOffre,
            'form' => $form->createView(),
        ));
    }


    /**
     * Finds and displays a reservationOffre entity.
     *
     */
    public function showAction(ReservationOffre $reservationOffre)
    {
        $deleteForm = $this->createDeleteForm($reservationOffre);

        return $this->render('LimitlessKarhabtiBundle:reservationoffre:show.html.twig', array(
            'reservationOffre' => $reservationOffre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservationOffre entity.
     *
     */
    public function editAction(Request $request, ReservationOffre $reservationOffre)
    {
        $deleteForm = $this->createDeleteForm($reservationOffre);
        $editForm = $this->createForm('Limitless\KarhabtiBundle\Form\ReservationOffreType', $reservationOffre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('reservationoffre_edit', array('id' => $reservationOffre->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:reservationoffre:edit.html.twig', array(
            'reservationOffre' => $reservationOffre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservationOffre entity.
     *
     */
    public function deleteAction(Request $request, ReservationOffre $reservationOffre)
    {
        $form = $this->createDeleteForm($reservationOffre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationOffre);
            $em->flush($reservationOffre);
        }

        return $this->redirectToRoute('reservationoffre_index');
    }

    /**
     * Creates a form to delete a reservationOffre entity.
     *
     * @param ReservationOffre $reservationOffre The reservationOffre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReservationOffre $reservationOffre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reservationoffre_delete', array('id' => $reservationOffre->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
