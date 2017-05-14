<?php
/**
 * Created by PhpStorm.
 * User: KHALIL-PC
 * Date: 16/02/2017
 * Time: 23:36
 */

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Form\UpdateAvisMoniteurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Limitless\KarhabtiBundle\Entity\AvisMoniteur;
use Limitless\KarhabtiBundle\Form\AvisMoniteurType;

class AvisMoniteurController extends Controller
{

    public function AjoutAvisAction(Request $request)
    {

        $avis = new AvisMoniteur();
        $form = $this->createForm(AvisMoniteurType::class, $avis);

        $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();
            return $this->redirectToRoute('AffichageAvis');

        }
        return $this->render('LimitlessKarhabtiBundle:AvisMoniteur:ajoutAvis.html.twig', array(
            'form' => $form->createView()));
    }

     public function AffichageAvisAction()
     {
         $em = $this->getDoctrine()->getManager();
         $modele = $em->getRepository('LimitlessKarhabtiBundle:AvisMoniteur')->findAll();
         return $this->render('LimitlessKarhabtiBundle:AvisMoniteur:affichageAvis.html.twig', array('avis' => $modele));

     }
    public function DeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $objet = $em->getRepository('LimitlessKarhabtiBundle:AvisMoniteur')->find($id);
        $em->remove($objet);
        $em->flush();
        return $this->redirectToRoute('AffichageAvis');
    }

    public function UpdateAvisAction(Request $request,$id)
    {
        $em = $this->getDoctrine()->getManager();
        $modele = $em->getRepository('LimitlessKarhabtiBundle:AvisMoniteur')->findBy(array('id' => $id));
        $avis = $em->getRepository('LimitlessKarhabtiBundle:AvisMoniteur')->find($id);
        $form = $this->createForm(UpdateAvisMoniteurType::class, $avis);

        $form->handleRequest($request);
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($avis);
            $em->flush();
            return $this->redirectToRoute('AffichageAvis');

        }
        return $this->render('LimitlessKarhabtiBundle:AvisMoniteur:updateAvis.html.twig', array(
            'form' => $form->createView(),'avis' => $modele));
    }

}