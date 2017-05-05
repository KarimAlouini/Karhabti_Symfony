<?php
/**
 * Created by PhpStorm.
 * User: islem
 * Date: 08/01/2017
 * Time: 14:36
 */

namespace Limitless\KarhabtiBundle\Controller;

    use Limitless\KarhabtiBundle\Entity\Offre;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Limitless\KarhabtiBundle\Form\OffreType;


    class OffreController extends Controller
    {
        public function addAction(Request $Request){
            $em=$this->getDoctrine()->getManager();

            $Offre = new Offre();
            $user = $this->getUser();
            $profil=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));

            $form=$this->createForm(OffreType::class,$Offre);
            $form->handleRequest($Request);
            $err1="";
            $err2="";
            $err3="";
            $err4="";
            $err5="";
            $err6="";
            if ($form->isValid())
            {
                if (is_numeric($Offre->getNom())) {
                    $err1 = "Le nom de l'offre doit etre un mot";
                }elseif(($Offre->getPrixUcode()<0)){
                    $err2 = "Le prix de unitaire code doit etre superieur a 0";
                }elseif($Offre->getPrixUconduite()<0){
                    $err3 = "Le prix de unitaire conduite doit etre superieur a 0";
                }else {


                    $em = $this->getDoctrine()->getManager();
                    $Offre->setAgence($profil);

                    $em->persist($Offre);
                    $em->flush();


                    return $this->redirect($this->generateUrl('responsable_offre_new', array('id' => $Offre->getId())));
                }

            }
            return $this->render("LimitlessKarhabtiBundle:Offre:add.html.twig",
                array('err1'=>$err1,
                    'err2'=>$err2,
                    'err3'=>$err3,
                    'err4'=>$err4,
                    'err5'=>$err5,
                    'err6'=>$err6,
                    "form"=>$form->createView()));
        }


        public function afficheAction(){

            //doctrine c est un servive est doctrine2 c est un orm
            $em=$this->getDoctrine()->getManager();
            $modeles=$em->getRepository('LimitlessKarhabtiBundle:Offre')->findAll();
            //print_r($modeles);exit();
            return $this->render("LimitlessKarhabtiBundle:Offre:affiche.html.twig",
                array("modeles"=>$modeles));



        }

        public function deleteAction($id){

            $em=$this->getDoctrine()->getManager();
            $modele=$em->getRepository('LimitlessKarhabtiBundle:Offre')->find($id);

            $em->remove($modele);
            $em->flush();
            return $this->redirectToRoute('responsable_offre_index');
        }

        public function updateAction(Request $Request,$id)
        {

            $em = $this->getDoctrine()->getManager();
            $modeles = $em->getRepository('LimitlessKarhabtiBundle:Offre')->find($id);


            $form = $this->createForm(OffreType::class, $modeles);
            $form->handleRequest($Request);
            $err1="";
            $err2="";
            $err3="";
            $err4="";
            $err5="";
            $err6="";
            if ($form->isSubmitted()&& $form->isValid()) {
                if (is_numeric($modeles->getNom())) {
                    $err1 = "Le nom doit etre un mot";
                }elseif(($modeles->getNbrHeureCode()<10)or ($modeles->getNbrHeureCode()>50)){
                    $err2 = "Veiller saisir un nombre entre 10 et 50 ";
                }elseif($modeles->getNbrHeureConduite()<10 or $modeles->getNbrHeureConduite()>50){
                    $err3 = "Veiller saisir un nombre entre 10 et 50";
                }elseif(($modeles->getPrixUcode()<0)){
                    $err4 = "Le prix de code doit etre superieur a 0";
                }elseif(($modeles->getPrixUconduite()<0)) {
                    $err5 = "Le prix de conduite doit etre superieur a 0";
                }elseif(($modeles->getPromotion()<0)) {
                    $err6 = "La promotion doit etre un nombre";
                }else {

                    var_dump($form->getData());
                    $em->persist($modeles);
                    $em->flush();
                    return $this->redirect($this->generateUrl('responsable_offre_index'));
                }

            }
            return $this->render("LimitlessKarhabtiBundle:Offre:add.html.twig",
                array('err1'=>$err1,
                    'err2'=>$err2,
                    'err3'=>$err3,
                    'err4'=>$err4,
                    'err5'=>$err5,
                    'err6'=>$err6,
                    "form"=>$form->createView()));
        }
        public function rechercherAction() {
            $request = $this->container->get('request_stack')->getCurrentRequest();
            $em = $this->container->get('doctrine')->getEntityManager();
            if ($request->isXmlHttpRequest()) {

                $motcle = $request->request->get('motcle');
                $query = $em->createQuery("SELECT m FROM LimitlessKarhabtiBundle:Offre m WHERE m.nom LIKE '$motcle%'");
                $produits = $query->getResult();


                return $this->container->get('templating')->renderResponse('LimitlessKarhabtiBundle:Offre:list.html.twig', array(
                    'modeles' => $produits
                ));
            } else {
                return $this->afficheAction();
            }
        }

        public function findAction(Request $Request){

            $em=$this->getDoctrine()->getManager();
            $user = $this->getUser();
            $profil=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));

            $modeles=  $em->getRepository('LimitlessKarhabtiBundle:Offre')->findBy(array('agence' => $profil));


            if($Request->isMethod('POST'))

            {
                $search=$Request->get('prixu');
                $modeles=$em->getRepository('LimitlessKarhabtiBundle:Offre')->findBy(array("prixUcode"=>$search));

            }

            return $this->render("LimitlessKarhabtiBundle:Offre:affiche.html.twig",
                array("modeles"=>$modeles));


        }

        public function showAction(Offre $offre)
        {


            return $this->render('LimitlessKarhabtiBundle:Offre:show.html.twig', array(
                'offre' => $offre,
            ));
        }


    }