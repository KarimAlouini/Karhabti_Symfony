<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 06/05/2017
 * Time: 09:56
 */

namespace Limitless\KarhabtiBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Limitless\KarhabtiBundle\Entity\Moniteur;
use Limitless\KarhabtiBundle\Form\MoniteurType;
use Limitless\KarhabtiBundle\Form\UpdateMoniteurType;

class MoniteurController extends Controller
{
    public function rechercheAction(Request $Request){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));

        $moniteur=  $em->getRepository('LimitlessKarhabtiBundle:Moniteur')->findBy(array('agence' => $profil));

        if($Request->isMethod('POST'))

        {
            $search=$Request->get('matricule');
            $moniteur=$em->getRepository('LimitlessKarhabtiBundle:Moniteur')->findBy(array("nom"=>$search,'agence' => $profil));

        }elseif ($Request->isMethod('POST')){
            $search=$Request->get('typeV');
            $moniteur=$em->getRepository('LimitlessKarhabtiBundle:Moniteur')->findBy(array("prenom"=>$search));
        }

        return $this->render('LimitlessKarhabtiBundle:Moniteur:list.html.twig',
            array("moniteur"=>$moniteur));
    }

    public function AffichageAction()
    {
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository('LimitlessKarhabtiBundle:Moniteur')->findAll();
        return $this->render('LimitlessKarhabtiBundle:Moniteur:affichage.html.twig', array('moniteur' => $modele));

    }

    public  function  AjoutAction(Request $request){

        $moniteur = new Moniteur();
        $user = $this->getUser();
        $form = $this->createForm(MoniteurType::class, $moniteur);

        $form->handleRequest($request);
        if ($form->isValid()) {



            $file = $moniteur->getPhoto();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('photos'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $moniteur->setPhoto($fileName);


            $em = $this->getDoctrine()->getManager();

            $moniteur->setUser($user);
            $em->persist($moniteur);
            $em->flush();
            return $this->redirectToRoute('AffichageMoniteur');

        }



        return $this->render('LimitlessKarhabtiBundle:Moniteur:ajoutmon.html.twig', array(
            'form' => $form->createView()));
    }

    public function DeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $objet = $em->getRepository('LimitlessKarhabtiBundle:Moniteur')->find($id);
        $em->remove($objet);
        $em->flush();
        return $this->redirectToRoute('AffichageMoniteur');
    }

    function UpdateAction(Request $request,$id) {

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('LimitlessKarhabtiBundle:Moniteur')->find($id);
        $form = $this->createForm(UpdateMoniteurType::class, $user);
        if ($form->handleRequest($request)->isValid()) {
            $file = $user->getPhoto();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('photos'),
                $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $user->setPhoto($fileName);


            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return($this->redirectToRoute('AffichageMoniteur'));
        }
        return $this->render("LimitlessKarhabtiBundle:Moniteur:updateMoniteur.html.twig", array('form' => $form->createView()));
    }



}