<?php

namespace Limitless\KarhabtiBundle\Controller;


use Limitless\KarhabtiBundle\Entity\Client;
use Limitless\KarhabtiBundle\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Limitless\KarhabtiBundle\Entity\User;



/**
 * Client controller.
 *
 */
class ClientController extends Controller
{
    /**
     * Lists all client entities.
     *
     */
    public function homeAction()
    {


        return $this->render('LimitlessKarhabtiBundle:Client:Home.html.twig');

    }
    public function rechercheAgenceAction(Request $Request){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $agence=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findAll();


        if($Request->isMethod('POST'))

        {
            $search=$Request->get('matricule');
            $agence=$em->getRepository('LimitlessKarhabtiBundle:Agence')->findBy(array("nom"=>$search,'agence' => $agence));

        }

        return $this->render('LimitlessKarhabtiBundle:Client:listAgence.html.twig',
            array("agence"=>$agence));
    }
    public function rechercheReservationAction(Request $Request){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Client')->findOneBy(array('user' => $user));
        $reservationOffres = $em->getRepository('LimitlessKarhabtiBundle:ReservationOffre')->findBy(array('client_id' => $profil));
        $reservationPacks = $em->getRepository('LimitlessKarhabtiBundle:ReservationPack')->findBy(array('client_id' => $profil));




        return $this->render('LimitlessKarhabtiBundle:Client:listAgence.html.twig',
            array(
                'reservationPacks' => $reservationPacks,
                'reservationOffres' => $reservationOffres,
            ));
    }
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Client')->findOneBy(array('user' => $user));

        $clients=  $em->getRepository('LimitlessKarhabtiBundle:Client')->findBy(array('id' => $profil));



        return $this->render('LimitlessKarhabtiBundle:Client:show.html.twig', array(
            'client' => $profil,
        ));
    }




    /**
     * Creates a new client entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $client = new Client();
        $form = $this->createForm('Limitless\KarhabtiBundle\Form\ClientType', $client);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $client->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            $imagesDir = $this->container->getParameter('images_directory');
            $file->move($imagesDir, $fileName);
            $client->setImage($fileName);
            $em = $this->getDoctrine()->getManager();
            $client->setUser($user);


            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('client_index', array('id' => $client->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:Client:new.html.twig', array(
            'client' => $client,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a client entity.
     *
     */
    public function showAction(Client $client)
    {

        $deleteForm = $this->createDeleteForm($client);

        return $this->render('LimitlessKarhabtiBundle:Client:show.html.twig', array(
            'client' => $client,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing client entity.
     *
     */
    public function editAction(Request $request, Client $client)
    {
        $deleteForm = $this->createDeleteForm($client);
        $editForm = $this->createForm('Limitless\KarhabtiBundle\Form\ClientType', $client);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $client->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $imagesDir = $this->container->getParameter('images_directory');
            $file->move($imagesDir, $fileName);
            $client->setImage($fileName);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('client_index', array('id' => $client->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:Client:edit.html.twig', array(
            'client' => $client,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a client entity.
     *
     */
    public function deleteAction(Request $request, Client $client)
    {
        $form = $this->createDeleteForm($client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($client);
            $em->flush($client);
        }

        return $this->redirectToRoute('client_index');
    }

    /**
     * Creates a form to delete a client entity.
     *
     * @param Client $client The client entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Client $client)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('client_delete', array('id' => $client->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
    /**
     * Creates a form to create a Client entity.
     *
     * @param Client $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Client $entity)
    {
        $form = $this->createForm(new ClientType(), $entity);

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }
    /**
     * Creates a form to edit a Client entity.
     *
     * @param Client $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Client $entity)
    {
        $form = $this->createForm(new ClientType(), $entity);

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }


}
