<?php

namespace Limitless\KarhabtiBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use Limitless\KarhabtiBundle\Entity\Moniteur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateMoniteurType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('civilite', ChoiceType::class, array(
            'choices' => array(
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
                'choices' => array(
                    'Tunis' => 'Tunis',
                    'Ariana' => 'Ariana',
                    'Mannouba' => 'Mannouba',
                    'Sfax' => 'Sfax',
                    'Kairouan' => 'Kairouan',
                    'Sousse' => 'Sousse',
                    'Monastir' => 'Monastir',
                    'Nabeul' => 'Nabeul',
                    'Tozeur' => 'Tozeur',
                    'Gabès' => 'Gabès',
                    'Le Kef' => 'Le Kef',
                    'Mednine' => 'Mednine',
                    'Kbeli' => 'Kbeli',
                    'Gafssa' => 'Gafssa',
                    'Gassrine' => 'Gassrine',
                    'Sidi Bouzid' => 'Sidi Bouzid',
                    'Siliana' => 'Siliana',
                    'Jandouba' => 'Jandouba',
                    'Beja' => 'Beja',
                    'Bizert' => 'Bizert ',
                    'Mahdia' => 'Mahdia',
                    'Ben arous' => 'Ben arous',
                    'Zagwen' => 'Zagwen',
                    'Tataouine' => 'Tataouine',
                ),
            ))
            ->add('codePostal')
            ->add('telephone')
            ->add('dateNaissance',DateType::class , array( 'widget' =>
                'single_text', 'format' => 'dd-MM-yyyy','attr' =>
                array('class' => 'input','data-provide' =>
                    'datepicker','data-date-format' => 'dd-mm-yyyy')))
            ->add('lieuNaissance')
            /*     ->add('rating', RatingType::class, [
                     'label' => 'Rating'
                 ])*/
            /*->add('agence', EntityType::class, array(
                'class' => 'LimitlessKarhabtiBundle:Agence',

                'choice_label' => 'nom',

            ))*/
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
