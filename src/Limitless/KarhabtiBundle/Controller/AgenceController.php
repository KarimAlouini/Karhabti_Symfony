<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\Agence;
use Limitless\KarhabtiBundle\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Agence controller.
 *
 */
class AgenceController extends Controller
{
    /**
     * Lists all agence entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $agences = $em->getRepository('LimitlessKarhabtiBundle:Agence')->findBy(array('user' => $user));

        return $this->render('LimitlessKarhabtiBundle:agence:index.html.twig', array(
            'agences' => $agences,
        ));
    }

    /**
     * Creates a new agence entity.
     *
     */
    public function newAction(Request $request)
    {
        $agence = new Agence();
        $user = $this->getUser();
        $form = $this->createForm('Limitless\KarhabtiBundle\Form\AgenceType', $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image= $form['file']->getData();

            $req = $request->request->get('limitless_karhabtibundle_agence');
            $id=$req['nom'];
            if(!is_dir("bundles/limitlesskarhabti/Image/Agence")){
                mkdir("bundles/limitlesskarhabti/Image/Agence");

            }

            mkdir("bundles/limitlesskarhabti/Image/Agence/".$id);
            move_uploaded_file ($image,"bundles/limitlesskarhabti/Image/Agence/".$id."/".$image->getFileName());
            rename("bundles/limitlesskarhabti/Image/Agence/".$id."/".$image->getFileName(), "bundles/limitlesskarhabti/Image/Agence/".$id."/".$id.".jpg");



            $em = $this->getDoctrine()->getManager();
            $agence->setUser($user);

            $em->persist($agence);
            $roles=array('ROLE_AGENCE');
            $user->setRoles($roles);
            $em->flush();
            $token = $this->get('security.token_storage')->getToken()->setAuthenticated(False);

            return $this->redirectToRoute('agence_index', array('id' => $agence->getId()));
        }


        return $this->render('LimitlessKarhabtiBundle:agence:new.html.twig', array(
            'agence' => $agence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agence entity.
     *
     */
    public function showAction(Agence $agence)
    {
        $deleteForm = $this->createDeleteForm($agence);


        return $this->render('LimitlessKarhabtiBundle:agence:show.html.twig', array(
            'agence' => $agence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agence entity.
     *
     */
    public function editAction(Request $request, Agence $agence)
    {
        $deleteForm = $this->createDeleteForm($agence);
        $editForm = $this->createForm('Limitless\KarhabtiBundle\Form\AgenceType', $agence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agence_show', array('id' => $agence->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:agence:edit.html.twig', array(
            'agence' => $agence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function avisAction(Request $request, Agence $agence)
    {

        $avisForm = $this->createForm('Limitless\KarhabtiBundle\Form\AvisForm', $agence);
        $avisForm->handleRequest($request);
        $old = $agence->getAvis();


        if ($avisForm->isSubmitted() && $avisForm->isValid()) {
            $new = $agence->getnewAvis();

            $avis = $old + $new;

            $agence->setAvis($avis);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agence_show', array('id' => $agence->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:agence:avis.html.twig', array(
            'edit_form' => $agence,
            'edit_form' => $avisForm->createView(),
            'agence' => $agence,


        ));
    }

    /**
     * Deletes a agence entity.
     *
     */
    public function deleteAction(Request $request, Agence $agence)
    {
        $form = $this->createDeleteForm($agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agence);
            $em->flush($agence);
        }

        return $this->redirectToRoute('agence_index');
    }

    /**
     * Creates a form to delete a agence entity.
     *
     * @param Agence $agence The agence entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Agence $agence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agence_delete', array('id' => $agence->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    public function chartAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();
        $Agence = $em->getRepository('LimitlessKarhabtiBundle:Agence') > findAll();
        $categories = array();
        $avis = array();
        foreach ($Agence as $agence) {
            array_push($nom, $agence->getNom());
            array_push($avis, $agence->getAvis());
        }
        $series = array(array('name' => 'Agence', 'type' => 'column', 'color' => '#4572A7', 'yAxis' => 0, 'data' => $avis,));
        $yData = array(array('labels' => array('agence' => new Expr('function () { return this.value + "" }'), 'style' => array('color' => '#4572A7')), 'gridLineWidth' => 0, 'title' => array('text' => 'Nombre dávis', 'style' => array('color' => '#4572A7')),),);
        $ob = new Highchart();
        $ob->chart->renderTo('container'); // The #id of the div where to render the chart
        $ob->chart->type('column');
        $ob->title->text('Nombre dàvis par agence');
        $ob->xAxis->categories($categories);
        $ob->yAxis($yData);
        $ob->legend->enabled(false);
        $formatter = new Expr('function ()
 { var unit = {"agence": "agence(s)", }[this.series.name];
 return this.x + ": <b>" + this.y + "</b> " + unit;}');
        $ob->tooltip->agence($agence);
        $ob->series($series);
        return $this > render('LimitlessKarhabtiBundle:Graphe:chart.html.twig', array('chart' => $ob));
    }
}
