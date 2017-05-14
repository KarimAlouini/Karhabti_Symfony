<?php

namespace Limitless\KarhabtiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class PDFController extends Controller
{
    public function pdfAction()
    {
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));
        $taches=$em->getRepository('LimitlessKarhabtiBundle:Tache')->findBy(array('agence' => $profil));

        $html = $this->renderView('@LimitlessKarhabti/PDF/pdf.html.twig', array('taches'=>$taches));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Planning.pdf"'
            )
        );
    }
    public function pdfMoniteurAction()
    {
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Moniteur')->findOneBy(array('user' => $user));
        $taches=  $em->getRepository('LimitlessKarhabtiBundle:Tache')->findBy(array('moniteur' => $profil));

        $html = $this->renderView('@LimitlessKarhabti/PDF/pdfMoniteur.html.twig', array('taches'=>$taches));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'attachment; filename="Planning.pdf"'
            )
        );
    }

}
