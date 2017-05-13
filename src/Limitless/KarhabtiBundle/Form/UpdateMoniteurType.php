<?php

namespace Limitless\KarhabtiBundle\Form;

use Limitless\KarhabtiBundle\Entity\Moniteur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use blackknight467\StarRatingBundle\Form\RatingType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class UpdateMoniteurType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('civilite', ChoiceType::class, array(
                'choices'  => array(
                    'M.' => 'M.',
                    'Mme.' => 'Mme.',
                    'Melle.' => 'Melle.',
                ),
            ))

            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('mail', EmailType::class)
            ->add('ville', ChoiceType::class, array(
                'choices'  => array(
                    'Tunis' => 'Tunis',
                    'Ariana' => 'Ariana',
                    'Nabeul' => 'Nabeul',
                ),
            ))
            ->add('codePostal')
            ->add('telephone')
            ->add('dateNaissance' , DateType::class, array(
                'years'=> range(1920,1999),
                ))
            ->add('lieuNaissance')
            /*     ->add('rating', RatingType::class, [
                     'label' => 'Rating'
                 ])*/
            ->add('agence', EntityType::class, array(
                'class' => 'LimitlessKarhabtiBundle:Agence',

                'choice_label' => 'nom',

            ))


          ->add('photo', FileType::class, array('label' => 'Photo de profile','data_class'=>null))

            ->add('save', SubmitType::class, array('label' => 'Modifier'))// ->add('agence')
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Limitless\KarhabtiBundle\Entity\Moniteur'
        ));
    }


    public function getBlockPrefix()
    {
        return 'limitless_karhabtibundle_moniteur';
    }


}
