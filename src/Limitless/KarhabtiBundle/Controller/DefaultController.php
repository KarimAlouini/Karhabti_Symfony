<?php

namespace Limitless\KarhabtiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));
        $vehicule=  $em->getRepository('LimitlessKarhabtiBundle:Vehicule')->findBy(array('agence' => $profil));
        $moniteur=  $em->getRepository('LimitlessKarhabtiBundle:Moniteur')->findBy(array('agence' => $profil));
        $client=  $em->getRepository('LimitlessKarhabtiBundle:Client')->findBy(array('agence' => $profil));
        $agences=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findBy(array('user' => $user));

        return $this->render('LimitlessKarhabtiBundle::layout.html.twig',array(
            'client' => $client,
            'vehicule' => $vehicule,
            'moniteur' => $moniteur,
            'agences' => $agences,
            'user' => $profil,
        ));
    }
    public function indexClientAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Client')->findOneBy(array('user' => $user));
        $moniteur=  $em->getRepository('LimitlessKarhabtiBundle:Moniteur')->findAll();
        $users=  $em->getRepository('LimitlessKarhabtiBundle:User')->findAll();
        $agences=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findBy(array('user' => $user));
        $cours=$em->getRepository('LimitlessKarhabtiBundle:Cours')->findAll();
        return $this->render('LimitlessKarhabtiBundle::layoutClient.html.twig',array(
            'users' => $users,
            'cours' => $cours,
            'moniteur' => $moniteur,
            'agences' => $agences,
            'user' => $profil,
        ));

    }
    public function testAction()
    {
        return $this->render('LimitlessKarhabtiBundle:Default:test.html.twig');
    }
}
