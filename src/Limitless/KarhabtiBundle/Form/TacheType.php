<?php

namespace Limitless\KarhabtiBundle\Form;


use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',DateType::class , array( 'widget' =>
                'single_text', 'format' => 'dd-MM-yyyy','attr' =>
                array('class' => 'input','data-provide' =>
                    'datepicker','data-date-format' => 'dd-mm-yyyy')))
            ->add('heure_debut',TimeType::class, array(
                'placeholder' => array(
                    'hour' => 'Hours','minute'=>'Minutes') ) )
            ->add('heure_fin',TimeType::class, array(
                'placeholder' => array(
                    'hour' => 'Hours','minute'=>'Minutes') ) )

            ->add('client')
            ->add('moniteur')        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Limitless\KarhabtiBundle\Entity\Tache'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'limitless_karhabtibundle_tache';
    }


}
