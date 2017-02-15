<?php

namespace Limitless\KarhabtiBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('file',FileType::class, array(
                    'multiple'    => false,
                    'attr' => array(

                        'accept' => 'image/*',
                    )
                )
            )
            ->add('date_expiration_assurance',DateType::class , array( 'widget' =>
                'single_text', 'format' => 'dd-MM-yyyy','attr' =>
                array('class' => 'input','data-provide' =>
                    'datepicker','data-date-format' => 'dd-mm-yyyy')))
            ->add('date_expiration_vignette',DateType::class , array( 'widget' =>
                'single_text', 'format' => 'dd-MM-yyyy','attr' =>
                array('class' => 'input','data-provide' =>
                    'datepicker','data-date-format' => 'dd-mm-yyyy')))
            ->add('date_expiration_visite',DateType::class , array( 'widget' =>
                'single_text', 'format' => 'dd-MM-yyyy','attr' =>
                array('class' => 'input','data-provide' =>
                    'datepicker','data-date-format' => 'dd-mm-yyyy')))
            ->add('marque')
            ->add('modele')
            ->add('typeV')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Limitless\KarhabtiBundle\Entity\Vehicule'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'limitless_karhabtibundle_vehicule';
    }


}
