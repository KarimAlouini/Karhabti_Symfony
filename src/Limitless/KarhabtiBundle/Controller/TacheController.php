<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\Tache;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tache controller.
 *
 */
class TacheController extends Controller
{
    /**
     * Lists all tache entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $taches = $em->getRepository('LimitlessKarhabtiBundle:Tache')->findAll();

        return $this->render('LimitlessKarhabtiBundle:Tache:list.html.twig', array(
            'taches' => $taches,
        ));
    }

    /**
     * Creates a new tache entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));


        $client=  $em->getRepository('LimitlessKarhabtiBundle:Client')->findBy(array('agence' => $profil));
        $moniteur=  $em->getRepository('LimitlessKarhabtiBundle:Moniteur')->findBy(array('agence' => $profil));

        $vehicule=  $em->getRepository('LimitlessKarhabtiBundle:Vehicule')->findBy(array('agence' => $profil,'reserved'=>false));

        $tache = new Tache();
        $form = $this->createForm('Limitless\KarhabtiBundle\Form\TacheType', $tache);
        $form->handleRequest($request);
        $err1="";
        $err2="";

        if ($form->isSubmitted() && $form->isValid()) {
            $ve=$request->request->get('vehicule');
            $vehicule=  $em->getRepository('LimitlessKarhabtiBundle:Vehicule')->findOneBy(array('matricule' => $ve));

            if($tache->getDate()<=(new \DateTime('now'))){
                $err1="Date  doit etre superieur ou egale à la date du jour";
            }elseif($tache->getHeureFin()<$tache->getHeureDebut()){
                $err2="Heure Fin doit etre supperieur à l'heure de debut";
            }else{
                $em = $this->getDoctrine()->getManager();
                $tache->setAgence($profil);

                $tache->setVehicule($vehicule);
                $vehicule=  $em->getRepository('LimitlessKarhabtiBundle:Vehicule')->findOneBy(array('matricule' => $ve));
                $vehicule->setReserved(true);
                $em->persist($tache);
                $em->flush($tache);
                $em->persist($vehicule);
                $em->flush();

            return $this->redirectToRoute('reponsable_tache_index', array('id' => $tache->getId()));
        }
        }

        return $this->render('LimitlessKarhabtiBundle:Tache:ajouter.html.twig', array(
            'tache' => $tache,
            'err1' => $err1,
            'moniteur'=>$moniteur,
            'client'=>$client,
            'vehicule'=>$vehicule,
            'err2' => $err2,
            'profil'=>$profil,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tache entity.
     *
     */


    /**
     * Displays a form to edit an existing tache entity.
     *
     */
    public function editAction(Request $request, Tache $tache)
    {
        $deleteForm = $this->createDeleteForm($tache);
        $editForm = $this->createForm('Limitless\KarhabtiBundle\Form\TacheType', $tache);
        $editForm->handleRequest($request);
        $err1="";
        $err2="";

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($tache->getDate()<=(new \DateTime('now'))){
                $err1="Date  doit etre superieur ou égale à la date du jour";
            }elseif($tache->getHeureFin()<$tache->getHeureDebut()){
                $err2="Heure Fin doit étre supperieur à l'heure de debut";
            }else {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('reponsable_tache_index', array('id' => $tache->getId()));
            }
        }

        return $this->render('LimitlessKarhabtiBundle:Tache:modifier.html.twig', array(
            'tache' => $tache,
            'err1' => $err1,
            'err2' => $err2,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tache entity.
     *
     */
    public function deleteAction(Request $request, Tache $tache)
    {
        $form = $this->createDeleteForm($tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tache);
            $em->flush($tache);
        }

        return $this->redirectToRoute('reponsable_tache_index');
    }

    /**
     * Creates a form to delete a tache entity.
     *
     * @param Tache $tache The tache entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tache $tache)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('reponsable_tache_delete', array('id' => $tache->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function rechercheAction(Request $Request){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));



        if($Request->isMethod('POST'))

        {
            $search=$Request->request->get('client');
            $tache=$em->getRepository('LimitlessKarhabtiBundle:Tache')->findBy(array("client"=>$search,'agence' => $profil));

        }else{
            $tache=  $em->getRepository('LimitlessKarhabtiBundle:Tache')->findBy(array('agence' => $profil));
        }

        return $this->render('LimitlessKarhabtiBundle:Tache:list.html.twig',
            array('taches' => $tache)
        );



    }



}
