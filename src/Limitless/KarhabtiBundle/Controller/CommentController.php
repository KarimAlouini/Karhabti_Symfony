<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\Comment;

use Limitless\KarhabtiBundle\Entity\Moniteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Comment controller.
 *
 */
class CommentController extends Controller
{

    /**
     * creer comment  a propos un moniteur
     */

    public function commentMoniteurAction(Request $request)
    {
        $comment = new Comment();
        $form = $this->createForm('Limitless\KarhabtiBundle\Form\CommentType', $comment);
        $form->handleRequest($request);
       $user = $this->get('security.token_storage')->getToken()->getUser();
        if ($form->isSubmitted() && $form->isValid()) {
            $mon = $form["moniteur"]->getData();
            $id= $mon->getId();
            $comment->setReserve($id);


            $em = $this->getDoctrine()->getManager();
            $comment->setDate(new \DateTime('now'));
            $comment->setUser($user);


            $em->persist($comment);
            $em->flush($comment);


            return $this->redirectToRoute('comment_moniteur_list', array('moniteur' => $id));
        }


        return $this->render('LimitlessKarhabtiBundle:comment:commentMoniteur.html.twig', array(
            'comment' => $comment,
            'form' => $form->createView(), ));

    }

    /**
     * liste des commentaire pour un moniteur
     */

    public function listCommentMoniteurAction(Moniteur $moniteur)
    {
        $em = $this->getDoctrine()->getManager();

        $comments = $em->getRepository('LimitlessKarhabtiBundle:Comment')->findByReserve($moniteur);

        return $this->render('LimitlessKarhabtiBundle:Comment:listeCommentMoniteur.html.twig', array(
            'comments' => $comments, 'moniteur' => $moniteur,
        ));
    }


}


