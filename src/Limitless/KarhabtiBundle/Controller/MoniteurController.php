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

}