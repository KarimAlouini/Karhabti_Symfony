<?php

namespace Limitless\KarhabtiBundle\Controller;

use Limitless\KarhabtiBundle\Entity\Vehicule;
use Limitless\KarhabtiBundle\LimitlessKarhabtiBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vehicule controller.
 *
 */
class VehiculeController extends Controller
{
    /**
     * Lists all vehicule entities.
     *
     */


    /**
     * Creates a new vehicule entity.
     *
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));

        $vehicule = new Vehicule();
        $form = $this->createForm('Limitless\KarhabtiBundle\Form\VehiculeType', $vehicule);
        $form->handleRequest($request);
        $err1="";
        $err2="";
        $err3="";
        if ($form->isSubmitted()) {
            if($vehicule->getDateExpirationAssurance()<(new \DateTime('now'))) {
                $err1="Date Expiration Assurance doit etre supperieur à la date du jour";
            }elseif ($vehicule->getDateExpirationVignette()<(new \DateTime('now'))) {
                $err2="Date Expiration Vignette doit etre supperieur à la date du jour";
            }elseif ($vehicule->getDateExpirationVisite()<(new \DateTime('now'))) {
                $err3="Date Expiration Visite doit etre supperieur à la date du jour";
            }else{
            $em = $this->getDoctrine()->getManager();
            $image= $form['file']->getData();

            $req = $request->request->get('limitless_karhabtibundle_vehicule');
            $id=$req['matricule'];

                $modele=$req['modele'];
                $modele=$em->getRepository('LimitlessKarhabtiBundle:Modele')->findOneBy(array("libelleMo"=>$modele));
                $vehicule->setModele($modele);
                $marque=$req['marque'];
                $marque=$em->getRepository('LimitlessKarhabtiBundle:Marque')->findOneBy(array("libelleMa"=>$marque));
                $vehicule->setMarque($marque);
                $vehicule->setAgence($profil);


                if(!is_dir("bundles/limitlesskarhabti/Image/Vehicule")){
                    mkdir("bundles/limitlesskarhabti/Image/Vehicule");

                }

                mkdir("bundles/limitlesskarhabti/Image/Vehicule/".$id);
                move_uploaded_file ($image,"bundles/limitlesskarhabti/Image/Vehicule/".$id."/".$image->getFileName());
                rename("bundles/limitlesskarhabti/Image/Vehicule/".$id."/".$image->getFileName(), "bundles/limitlesskarhabti/Image/Vehicule/".$id."/".$id.".jpg");



            $em->persist($vehicule);
            $em->flush();

            return $this->redirectToRoute('responsable_vehicule_index', array('id' => $vehicule->getId()));
            }

            }


        return $this->render('LimitlessKarhabtiBundle:Vehicule:ajouter.html.twig', array(
            'vehicule' => $vehicule,
            'err1' => $err1,
            'err2' => $err2,
            'err3' => $err3,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vehicule entity.
     *
     */
    public function showAction(Vehicule $vehicule)
    {

        $deleteForm = $this->createDeleteForm($vehicule);

        return $this->render('@LimitlessKarhabti/Vehicule/show.html.twig', array(
            'vehicule' => $vehicule,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vehicule entity.
     *
     */
    public function editAction(Request $request, Vehicule $vehicule)
    {
        $deleteForm = $this->createDeleteForm($vehicule);
        $editForm = $this->createForm('Limitless\KarhabtiBundle\Form\VehiculeType', $vehicule);
        $editForm->handleRequest($request);
        $err1="";
        $err2="";
        $err3="";

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            if($vehicule->getDateExpirationAssurance()<(new \DateTime('now'))) {
                $err1="Date Expiration Assurance doit etre supperieur à la date du jour";
            }elseif ($vehicule->getDateExpirationVignette()<(new \DateTime('now'))) {
                $err2="Date Expiration Vignette doit etre supperieur à la date du jour";
            }elseif ($vehicule->getDateExpirationVisite()<(new \DateTime('now'))) {
                $err3="Date Expiration Visite doit etre supperieur à la date du jour";
            }else {
                $em = $this->getDoctrine()->getManager();
                $image= $editForm['file']->getData();

                $req = $request->request->get('limitless_karhabtibundle_vehicule');
                $id=$req['matricule'];
                if(!is_dir("bundles/limitlesskarhabti/Image/Vehicule")){
                    mkdir("bundles/limitlesskarhabti/Image/Vehicule");

                }

                mkdir("bundles/limitlesskarhabti/Image/Vehicule/".$id);
                move_uploaded_file ($image,"bundles/limitlesskarhabti/Image/Vehicule/".$id."/".$image->getFileName());
                rename("bundles/limitlesskarhabti/Image/Vehicule/".$id."/".$image->getFileName(), "bundles/limitlesskarhabti/Image/Vehicule/".$id."/".$id.".jpg");

                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('responsable_vehicule_index', array('id' => $vehicule->getId()));
            }
        }

        return $this->render('LimitlessKarhabtiBundle:Vehicule:modifier.html.twig', array(
            'vehicule' => $vehicule,
            'err1' => $err1,
            'err2' => $err2,
            'err3' => $err3,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a vehicule entity.
     *
     */
    public function deleteAction(Request $request, Vehicule $vehicule)
    {
        $form = $this->createDeleteForm($vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vehicule);
            $em->flush($vehicule);
        }

        return $this->redirectToRoute('responsable_vehicule_index');
    }

    /**
     * Creates a form to delete a vehicule entity.
     *
     * @param Vehicule $vehicule The vehicule entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Vehicule $vehicule)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('responsable_vehicule_delete', array('id' => $vehicule->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
  public function deleteidAction( $id)
    {

            $em = $this->getDoctrine()->getManager();
        $vehicule=$em->getRepository('LimitlessKarhabtiBundle:Vehicule')->findOneBy(array("id"=>$id));
        $taches=$em->getRepository('LimitlessKarhabtiBundle:Tache')->findBy(array("vehicule"=>$vehicule));

            for($j=0;$j<count($taches);$j++){

                $taches[$j]->setVehicule(null);

                $em->persist($taches[$j]);
                $em->flush();
            }



            $em->remove($vehicule);
            $em->flush();


        return $this->redirectToRoute('responsable_vehicule_index');
    }

    public function rechercheAction(Request $Request){

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $profil=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));

        $vehicule=  $em->getRepository('LimitlessKarhabtiBundle:Vehicule')->findBy(array('agence' => $profil));

        if($Request->isMethod('POST'))

        {
            $search=$Request->get('matricule');
            $vehicule=$em->getRepository('LimitlessKarhabtiBundle:Vehicule')->findBy(array("matricule"=>$search,'agence' => $profil));

        }elseif ($Request->isMethod('POST')){
            $search=$Request->get('typeV');
            $vehicule=$em->getRepository('LimitlessKarhabtiBundle:Vehicule')->findBy(array("typeV"=>$search));
        }

        return $this->render('LimitlessKarhabtiBundle:Vehicule:list.html.twig',
            array("vehicule"=>$vehicule));



    }









}
