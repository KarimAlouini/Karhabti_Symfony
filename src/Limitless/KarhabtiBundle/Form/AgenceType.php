<?php

namespace Limitless\KarhabtiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class AgenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom')
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


                )))
            ->add('adresse')
            ->add('code_postal')
            ->add('telephone')
            ->add('num_fiscal')
            ->add('file',FileType::class, array(
                    'multiple'    => false,
                    'attr' => array(

                        'accept' => 'image/*',
                    )
                )
            )
            ->add('Ouverture', ChoiceType::class, array(
                'choices' => array(
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi'
                ), 'placeholder' => 'Ouvre le') )
            ->add('Fermeture', ChoiceType::class, array(
        'choices' => array(
            'Lundi' => 'Lundi',
            'Mardi' => 'Mardi',
            'Mercredi' => 'Mercredi',
            'Jeudi' => 'Jeudi',
            'Vendredi' => 'Vendredi',
            'Samedi' => 'Samedi')
        , 'placeholder' => 'Ferme le'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Limitless\KarhabtiBundle\Entity\Agence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'limitless_karhabtibundle_agence';
    }

  
}
