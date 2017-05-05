<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\ReservationPack;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Limitless\KarhabtiBundle\Entity\Client;
use Limitless\KarhabtiBundle\Entity\Mail;

/**
 * Reservationpack controller.
 *
 */
class ReservationPackController extends Controller
{
    /**
     * Lists all reservationPack entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $reservationPacks = $em->getRepository('LimitlessKarhabtiBundle:ReservationPack')->findAll();

        return $this->render('LimitlessKarhabtiBundle:reservationpack:index.html.twig', array(
            'reservationPacks' => $reservationPacks,
        ));
    }

    /**
     * Creates a new reservationPack entity.
     *
     */
    public function newAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=$em->getRepository('LimitlessKarhabtiBundle:Client')->findOneBy(array('user' => $user));
        $reservationPack = new Reservationpack();
        $email=$this->getUser()->getEmail();
        $mail = new Mail();
        $pack=$em->getRepository('LimitlessKarhabtiBundle:Pack')->find($id);
        $form = $this->createForm('Limitless\KarhabtiBundle\Form\ReservationPackType', $reservationPack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $message= \Swift_Message::newInstance()
                ->setSubject('Contact')
                ->setFrom('karhabti210@gmail.com')
                ->setTo('ali.methnani@esprit.tn')
                ->setBody('Votre Pack est reservé' );
            $this->get('mailer')->send($message);

            $reservationPack->setPack($pack) ;
            $reservationPack->setClient($profil);

            $em->persist($reservationPack);
            $em->flush();

            return $this->redirectToRoute('client_reservationpack_show', array('id' => $reservationPack->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:reservationpack:new.html.twig', array(
            'client'=>$profil,
            'reservationPack' => $reservationPack,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a reservationPack entity.
     *
     */
    public function showAction(ReservationPack $reservationPack)
    {
        $deleteForm = $this->createDeleteForm($reservationPack);

        return $this->render('LimitlessKarhabtiBundle:reservationpack:show.html.twig', array(
            'reservationPack' => $reservationPack,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing reservationPack entity.
     *
     */
    public function editAction(Request $request, ReservationPack $reservationPack)
    {
        $deleteForm = $this->createDeleteForm($reservationPack);
        $editForm = $this->createForm('Limitless\KarhabtiBundle\Form\ReservationPackType', $reservationPack);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_reservationpack_edit', array('id' => $reservationPack->getId()));
        }

        return $this->render('reservationpack/edit.html.twig', array(
            'reservationPack' => $reservationPack,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a reservationPack entity.
     *
     */
    public function deleteAction(Request $request, ReservationPack $reservationPack)
    {
        $form = $this->createDeleteForm($reservationPack);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($reservationPack);
            $em->flush($reservationPack);
        }

        return $this->redirectToRoute('client_reservationpack_index');
    }

    /**
     * Creates a form to delete a reservationPack entity.
     *
     * @param ReservationPack $reservationPack The reservationPack entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ReservationPack $reservationPack)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('client_reservationpack_delete', array('id' => $reservationPack->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
