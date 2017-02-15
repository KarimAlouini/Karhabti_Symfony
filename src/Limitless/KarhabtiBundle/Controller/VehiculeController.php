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
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vehicules = $em->getRepository('LimitlessKarhabtiBundle:Vehicule')->findAll();

        return $this->render('LimitlessKarhabtiBundle:Vehicule:list.html.twig', array(
            'vehicules' => $vehicules,
        ));
    }

    /**
     * Creates a new vehicule entity.
     *
     */
    public function newAction(Request $request)
    {
        $vehicule = new Vehicule();
        $form = $this->createForm('Limitless\KarhabtiBundle\Form\VehiculeType', $vehicule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $image= $form['file']->getData();

            $req = $request->request->get('limitless_karhabtibundle_vehicule');
            $id=$req['matricule'];

         try {
                if(!is_dir("bundles/limitlesskarhabti/Image/Vehicule")){
                    mkdir("bundles/limitlesskarhabti/Image/Vehicule");

                }

                mkdir("bundles/limitlesskarhabti/Image/Vehicule/".$id);
                move_uploaded_file ($image,"bundles/limitlesskarhabti/Image/Vehicule/".$id."/".$image->getFileName());
                rename("bundles/limitlesskarhabti/Image/Vehicule/".$id."/".$image->getFileName(), "bundles/limitlesskarhabti/Image/Vehicule/".$dir."/".$dir.".jpg");

            }

            catch (IOExceptionInterface $e) {
                echo "Erreur Profil existant ou erreur upload image ".$e->getPath();
            }

            $em->persist($vehicule);
            $em->flush($vehicule);

            return $this->redirectToRoute('responsable_vehicule_index', array('id' => $vehicule->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:Vehicule:ajouter.html.twig', array(
            'vehicule' => $vehicule,
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

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('responsable_vehicule_index', array('id' => $vehicule->getId()));
        }

        return $this->render('LimitlessKarhabtiBundle:Vehicule:modifier.html.twig', array(
            'vehicule' => $vehicule,
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

}
