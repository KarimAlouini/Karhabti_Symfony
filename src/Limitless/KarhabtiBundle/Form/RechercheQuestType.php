<?php
/**
 * Created by PhpStorm.
 * User: Emma
 * Date: 12/02/2017
 * Time: 12:15
 */

namespace Myapp\UserBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheQuestType extends abstractType
{

    public function buildForm(FormBuilderInterface $builder ,array $options)
    {$builder

        ->add('Test',EntityType::class ,array(

            'class'=> 'MyappUserBundle:Test',
            'choice_label'=>'nom',
        ))

        ->add('Valider',SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {

    }
    public function getName()
    {
        return 'esprit_parc_bundle_recherche_modele_form';
    }
}