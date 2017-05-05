<?php
/**
 * Created by PhpStorm.
 * User: islem
 * Date: 08/01/2017
 * Time: 14:36
 */

namespace Limitless\KarhabtiBundle\Controller;

    use Limitless\KarhabtiBundle\Entity\Pack;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Request;
    use Limitless\KarhabtiBundle\Form\PackType;


    class PackController extends Controller
    {
        public function addpackAction(Request $Request)
        {

            $Pack = new Pack();

            $form = $this->createForm(PackType::class, $Pack);
            $form->handleRequest($Request);
            $err1="";
            $err2="";
            $err3="";
            $err4="";
            $err5="";
            $err6="";
            if ($form->isValid()) {
                if (is_numeric($Pack->getNom())) {
                    $err1 = "Le nom de pack doit etre un mot";
                }elseif(($Pack->getNbrHeureCode()<10)or ($Pack->getNbrHeureCode()>50)){
                    $err2 = "Veiller saisir un nombre entre 10 et 50 ";
                }elseif($Pack->getNbrHeureConduite()<10 or $Pack->getNbrHeureConduite()>50){
                    $err3 = "Veiller saisir un nombre entre 10 et 50";
                }elseif(($Pack->getPrixUcode()<0)){
                    $err4 = "Le prix unitaire de code doit etre superieur a 0";
                }elseif(($Pack->getPrixUconduite()<0)) {
                    $err5 = "Le prix unitaire de conduite doit etre superieur a 0";
                }elseif(($Pack->getPromotion()<0)) {
                    $err6 = "La promotion doit etre un nombre";
                }else{


                        $em = $this->getDoctrine()->getManager();

                        $user = $this->getUser();
                        $profil = $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));
                        $prixucode = $form->get('prixUcode')->getData();
                        $prixuconduit = $form->get('prixUconduite')->getData();
                        $nbrHcode = $form->get('nbr_heure_code')->getData();
                        $nbrHconduit = $form->get('nbr_heure_conduite')->getData();
                        $prmotion = $form->get('promotion')->getData();
                        $prix1 = (($prixucode * $nbrHcode) + ($prixuconduit * $nbrHconduit));

                        $prixtotal = $prix1 - ($prix1 * $prmotion) / 100;
                        $Pack->setPrixtotal($prixtotal);
                        $Pack->setAgence($profil);
                        $em->persist($Pack);
                        $em->flush();

                        return $this->redirect($this->generateUrl('responsable_pack_index'));
                    }
                }



            return $this->render("@LimitlessKarhabti/Pack/addpack.html.twig",
                array('err1'=>$err1,
                    'err2'=>$err2,
                    'err3'=>$err3,
                    'err4'=>$err4,
                    'err5'=>$err5,
                    'err6'=>$err6,
                    "form" => $form->createView()));
        }

        public function affichepackAction()
        {

            //doctrine c est un servive est doctrine2 c est un orm
            $em = $this->getDoctrine()->getManager();
            $modeles = $em->getRepository('LimitlessKarhabtiBundle:Pack')->findAll();

            //print_r($modeles);exit();
            return $this->render("LimitlessKarhabtiBundle:Pack:affichepack.html.twig",
                array("modeles" => $modeles));
        }

        public function deletepackAction($id)
        {

            $em = $this->getDoctrine()->getManager();
            $modele = $em->getRepository('LimitlessKarhabtiBundle:Pack')->find($id);
            $em->remove($modele);
            $em->flush();
            return $this->redirectToRoute('responsable_pack_index');
        }
        public function updatepackAction(Request $Request,$id)
        {

            $em = $this->getDoctrine()->getManager();

            $modeles = $em->getRepository('LimitlessKarhabtiBundle:Pack')->find($id);


            $form = $this->createForm(PackType::class, $modeles);
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
                }else{

                var_dump($form->getData());
                $em->persist($modeles);
                $prixucode = $form->get('prixUcode')->getData();
                $prixuconduit = $form->get('prixUconduite')->getData();
                $nbrHcode = $form->get('nbr_heure_code')->getData();
                $nbrHconduit = $form->get('nbr_heure_conduite')->getData();
                $prmotion = $form->get('promotion')->getData();
                $prix1 = (($prixucode * $nbrHcode) + ($prixuconduit * $nbrHconduit));

                $prixtotal = $prix1 - ($prix1 * $prmotion) / 100;
                $modeles->setPrixtotal($prixtotal);
                $em->flush();
                return $this->redirect($this->generateUrl('responsable_pack_index'));
                    }

            }
            return $this->render("LimitlessKarhabtiBundle:Pack:addpack.html.twig",
                array('err1'=>$err1,
                    'err2'=>$err2,
                    'err3'=>$err3,
                    'err4'=>$err4,
                    'err5'=>$err5,
                    'err6'=>$err6,
                    "form"=>$form->createView()));
        }
        public function findpackAction(Request $Request){

            $em=$this->getDoctrine()->getManager();
            $user = $this->getUser();
            $profil=  $em->getRepository('LimitlessKarhabtiBundle:Agence')->findOneBy(array('user' => $user));

            $modeles=  $em->getRepository('LimitlessKarhabtiBundle:Pack')->findBy(array('agence' => $profil));


            if($Request->isMethod('POST'))

            {
                $search=$Request->get('prixtotal');
                $modeles=$em->getRepository('LimitlessKarhabtiBundle:Pack')->findBy(array("prixtotal"=>$search));
            }
            return $this->render("LimitlessKarhabtiBundle:Pack:affichepack.html.twig",
                array("modeles"=>$modeles));



        }
        public function showpackAction(Pack $pack)
        {


            return $this->render('LimitlessKarhabtiBundle:Pack:showpack.html.twig', array(
                'pack' => $pack,
            ));
        }

    }