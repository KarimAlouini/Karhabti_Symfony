<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\Cours;
use Limitless\KarhabtiBundle\Form\CoursType;
use Limitless\KarhabtiBundle\Form\RechercherType;
use Limitless\KarhabtiBundle\Form\UpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoursController extends Controller
{

    public function AjouterAction(Request $request)
    {
        $cours = new Cours();
        $form=$this->createForm(CoursType::class,$cours);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $file = $cours->getContenue();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('brochures_directory'),$fileName);
            $cours->setContenue($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($cours);
            $em->flush();
            return $this->redirectToRoute('responsable_cours_List');
        }

       return $this->render('LimitlessKarhabtiBundle:Cours:cours.html.twig',array('form'=>$form->createView()));
    }

    public function ListAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $Listecours=$em->getRepository('LimitlessKarhabtiBundle:Cours')->findAll();
        $cours = $this->get('knp_paginator')->paginate(
            $Listecours, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );

        return $this->render('LimitlessKarhabtiBundle:Cours:list.html.twig',array("Cours"=>$cours));
    }

    public function DeleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $cours=$em->getRepository('LimitlessKarhabtiBundle:Cours')->find($id);
        $em->remove($cours);
        $em->flush();
        return $this->redirectToRoute('responsable_cours_List');
    }


    public function UpdateAction(Request $request,$id)
    {
        $em=$this->getDoctrine()->getManager();
        $cours=$em->getRepository('LimitlessKarhabtiBundle:Cours')->find($id);
        $form=$this->createForm(UpdateType::class,$cours);
        $form->handleRequest($request);
        if  ($form->isValid()){
            $file = $cours->getContenue();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('brochures_directory'),$fileName);
            $cours->setContenue($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($cours);
            $em->flush();
            return $this->redirectToRoute('responsable_cours_List');
        }

        return $this->render('LimitlessKarhabtiBundle:Cours:Update.html.twig',array('form'=>$form->createView()));
    }

    public function RechercheAction(Request $Request)
    {
        $cours = new Cours();
        $form=$this->createForm(RechercherType::class,$cours);
        $form->handleRequest($Request);
        $em=$this->getDoctrine()->getManager();
        if($form->isValid())
        {
            $cours=$em->getRepository('LimitlessKarhabtiBundle:Cours')->findBy(array('dateajout'=>$cours->getDateajout()));

        }

        else
        {
            $cours=$em->getRepository('LimitlessKarhabtiBundle:Cours')->findAll();
        }
        return $this->render('LimitlessKarhabtiBundle:Cours:rechercher.html.twig',array('form'=>$form->createView(),'Cours'=>$cours));
    }


}

