<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\Cours;
use Limitless\KarhabtiBundle\Entity\Examen;
use Limitless\KarhabtiBundle\Entity\Question;
use Limitless\KarhabtiBundle\Entity\Reponse;
use Limitless\KarhabtiBundle\Form\CoursType;
use Limitless\KarhabtiBundle\Form\ExamenType;
use Limitless\KarhabtiBundle\Form\RechercherExam;
use Limitless\KarhabtiBundle\Form\RechercherType;
use Limitless\KarhabtiBundle\Form\UpdateCoursType;
use Limitless\KarhabtiBundle\Form\UpdateExamen;
use Limitless\KarhabtiBundle\Form\UpdateType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ExamenController extends Controller
{

    public function AjouterAction(Request $request){

        $em = $this->getDoctrine()->getManager();

            $examen = new Examen();
            $form = $this->createForm(ExamenType::class,$examen);
            $form->handleRequest($request);
            if ($form->isValid()) {
                $uploaded_file = $form['image']->getData();
                if ($uploaded_file) {
                    $image = ExamenType::processImage($uploaded_file);
                    $examen->setImage($image);
                }

                $em->persist($examen);
                $em->flush();
                return $this->redirectToRoute('responsable_examen_Liste');
            }

        return $this->render("LimitlessKarhabtiBundle:Examen:examen.html.twig", array(
            "form" => $form->createView()
        ));


    }
    public function ListClientAction(Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $Listeexamens=$em->getRepository('LimitlessKarhabtiBundle:Examen')->findAll();




        return $this->render('LimitlessKarhabtiBundle:Client:listExamen.html.twig',array("examen"=>$Listeexamens));
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        //$request = $this->getRequest();
        $examen = new Examen();
        $titre = $request->get("titre");
        //return new JsonResponse($nom);
        $uploaded_file = $request->files->get('file');

        $q1 = $request->get("q1");
        //print_r($q1);

        $q2 = $request->get("q2");
        $q3 = $request->get("q3");
        $q4 = $request->get("q4");
        $q5 = $request->get("q5");
        $q6 = $request->get("q6");
        $q7 = $request->get("q7");
        $q8 = $request->get("q8");
        $q9 = $request->get("q9");
        $q10 = $request->get("q10");
        $question1 = $em->getRepository("LimitlessKarhabtiBundle:Question")->find($q1);
        $question2 = $em->getRepository("LimitlessKarhabtiBundle:Question")->find($q2);
        $question3 = $em->getRepository("LimitlessKarhabtiBundle:Question")->find($q3);
        $question4= $em->getRepository("LimitlessKarhabtiBundle:Question")->find($q4);
        $question5 = $em->getRepository("LimitlessKarhabtiBundle:Question")->find($q5);
        $question6 = $em->getRepository("LimitlessKarhabtiBundle:Question")->find($q6);
        $question7 = $em->getRepository("LimitlessKarhabtiBundle:Question")->find($q7);
        $question8 = $em->getRepository("LimitlessKarhabtiBundle:Question")->find($q8);
        $question9 = $em->getRepository("LimitlessKarhabtiBundle:Question")->find($q9);
        $question10 = $em->getRepository("LimitlessKarhabtiBundle:Question")->find($q10);
        if ($uploaded_file) {
            $image = ExamenType::processImage($uploaded_file);
            $examen->setImage($image);
        }else{
            $examen->setImage("no image");
        }

        $examen->setTitre($titre);
        $examen->setQuestion1($question1);
        $examen->setQuestion2($question2);
        $examen->setQuestion3($question3);
        $examen->setQuestion4($question4);
        $examen->setQuestion5($question5);
        $examen->setQuestion6($question6);
        $examen->setQuestion7($question7);
        $examen->setQuestion8($question8);
        $examen->setQuestion9($question9);
        $examen->setQuestion10($question10);
        $em->persist($examen);
        $em->flush();
        return new JsonResponse("c bon");
    }

    public function UpdatexamAction(Request $request,$id)

        {
            $em = $this->getDoctrine()->getManager();
            $examen = $em->getRepository("LimitlessKarhabtiBundle:Examen")->find($id);
            $form = $this->createForm(UpdateExamen::class, $examen);
            $form->handleRequest($request);

        if($form->isValid()) {
            $uploaded_file = $form['image']->getData();
            if ($uploaded_file) {
                $image = ExamenType::processImage($uploaded_file);
                $examen->setImage($image);
            }

            $em->persist($examen);
            $em->flush();
            return $this->redirect($this->generateUrl('responsable_examen_Liste'));
        }

        return $this->render('LimitlessKarhabtiBundle:Examen:Update.html.twig',array('form'=>$form->createView()));
    }

    public function ListAction(Request $request)

    {
        $em=$this
            ->getDoctrine()
            ->getManager();
        $Listeexamen=$em
            ->getRepository('LimitlessKarhabtiBundle:Examen')
            ->findAll();

        $examen = $this->get('knp_paginator')->paginate(
            $Listeexamen, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            2/*limit per page*/
        );

        return $this->render('LimitlessKarhabtiBundle:Examen:list.html.twig',array("examen"=>$examen));
    }

    public function DeleteAction($id)
    {
        $em =$this->getDoctrine()-> getManager();
        $examen=$em->getRepository("LimitlessKarhabtiBundle:Examen")->find($id);
        $em->remove($examen);
        $em->flush();
        return ($this->redirectToRoute('responsable_examen_Liste'));
    }


    public function passerexamenAction(Request $request)
    {
        $examen=new Examen();
        $em=$this->getDoctrine()->getManager();
        $form=$this->createForm(RechercherExam::class,$examen);
        $form->handleRequest($request);
        if($form->isValid())
        {
            $examen=$em->getRepository("LimitlessKarhabtiBundle:Examen")->findBy(array('titre'=>$examen->getTitre()));
        }
        else{
            $examen=$em->getRepository("LimitlessKarhabtiBundle:Examen")->findAll();
        }
        return $this->render("LimitlessKarhabtiBundle:Examen:quiz.html.twig", array('form'=>$form->createView(),'examen'=>$examen));
    }






}

