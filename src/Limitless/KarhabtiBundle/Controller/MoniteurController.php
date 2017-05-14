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
            $image = $form['file']->getData();

            $req = $request->request->get('limitless_karhabtibundle_moniteur');
            $id = $req['nom'];
            if (!is_dir("bundles/limitlesskarhabti/Image/Moniteur")) {
                mkdir("bundles/limitlesskarhabti/Image/Moniteur");

            }

            mkdir("bundles/limitlesskarhabti/Image/Moniteur/" . $id);
            move_uploaded_file($image, "bundles/limitlesskarhabti/Image/Moniteur/" . $id . "/" . $image->getFileName());
            rename("bundles/limitlesskarhabti/Image/Moniteur/" . $id . "/" . $image->getFileName(), "bundles/limitlesskarhabti/Image/Moniteur/" . $id . "/" . $id . ".jpg");



            $em = $this->getDoctrine()->getManager();

            $moniteur->setUser($user);
            $em->persist($moniteur);
            $roles=array('ROLE_MONITEUR');
            $user->setRoles($roles);

            $token = $this->get('security.token_storage')->getToken()->setAuthenticated(False);
            $em->flush();
            return $this->redirectToRoute('moniteur_index');

        }



        return $this->render('LimitlessKarhabtiBundle:Moniteur:new.html.twig', array(
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



            $em = $this->getDoctrine()->getManager();
            $em->persist($user);

            $em->flush();
            return($this->redirectToRoute('moniteur_index'));
        }
        return $this->render("LimitlessKarhabtiBundle:Moniteur:updateMoniteur.html.twig", array('form' => $form->createView()));
    }

    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Moniteur')->findOneBy(array('user' => $user));

        $moniteur=  $em->getRepository('LimitlessKarhabtiBundle:Moniteur')->findBy(array('id' => $profil));



        return $this->render('LimitlessKarhabtiBundle:Moniteur:show.html.twig', array(
            'client' => $profil,
        ));
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

        return $this->render('LimitlessKarhabtiBundle:Moniteur:listAgence.html.twig',
            array("agence"=>$agence));
    }



}