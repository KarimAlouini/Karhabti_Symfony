<?php

namespace Limitless\KarhabtiBundle\Controller;
use Doctrine\Bundle\DoctrineBundle\Tests\DependencyInjection\TestType;
use Limitless\KarhabtiBundle\Entity\Question;
use Limitless\KarhabtiBundle\Form\QuestionType;
use Limitless\KarhabtiBundle\Form\UpdateQuestion;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class QuestionController extends Controller

{
    public function AjouterAction(Request $request)
    {
        $ques = new Question();
        $form = $this->createForm(QuestionType::class, $ques);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($ques);
            $em->flush();
            return $this->redirectToRoute('responsable_question_List');
        }
        return $this->render('LimitlessKarhabtiBundle:Question:question.html.twig', array('form' => $form->createView()));
    }


    public function ListAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Listeques=$em->getRepository('LimitlessKarhabtiBundle:Question')->findAll();
        $ques = $this->get('knp_paginator')->paginate(
            $Listeques, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            5/*limit per page*/
        );
        return $this->render('LimitlessKarhabtiBundle:Question:list.html.twig', array('question' => $ques));
    }

    public function DeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $ques = $em->getRepository('LimitlessKarhabtiBundle:Question')->find($id);
        $em->remove($ques);
        $em->flush();
        return $this->redirectToRoute('responsable_question_List');
    }


    public function UpdatequesAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $ques = $em->getRepository('LimitlessKarhabtiBundle:Question')->find($id);
        $form = $this->createForm(UpdateQuestion::class, $ques);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $em->persist($ques);
            return $this->redirectToRoute('responsable_question_List');
        }

        return $this->render('LimitlessKarhabtiBundle:Question:Update.html.twig', array('form' => $form->createView()));
    }

    public function RechercherAction(Request $request)
    {
            $question = new Question();
            $em = $this->getDoctrine()->getManager();
            $form = $this->createForm(QuestionType::class, $question);
            $form->handleRequest($request);

        if ($form->isValid()) {
            $question = $em->getRepository("LimitlessKarhabtiBundle:Question")->findBy(array('examen' => $question->getExamen()));
        } else {
            $question = $em->getRepository("LimitlessKarhabtiBundle:Question")->findAll();
        }
        return $this->render("LimitlessKarhabtiBundle:Question:list.html.twig", array('Form' => $form->createView(), 'questions' => $question));
    }


}

