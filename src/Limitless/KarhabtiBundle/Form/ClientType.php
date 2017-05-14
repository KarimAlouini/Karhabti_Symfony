<?php

namespace Limitless\KarhabtiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('civilite',ChoiceType::class, array('choices'=>array('Monsieur'=>'Monsieur','Madame'=>'Madame','Mademoiselle'=>'Mademoiselle')))
            ->add('nom')
            ->add('file',FileType::class, array(
                    'multiple'    => false,
                    'attr' => array(

                        'accept' => 'image/*',
                    )
                )
            )
            ->add('prenom')
            ->add('adresse')
            ->add('ville')
            ->add('codePostal')
            ->add('telephone')
            ->add('dateNaissance',DateType::class, array( 'widget' =>
                'single_text', 'format' => 'dd-MM-yyyy','attr' =>
                array('class' => 'input','data-provide' =>
                    'datepicker','data-date-format' => 'dd-mm-yyyy')))
            ->add('villeNaissance')
            ->add('etatCode')
            ->add('image',FileType::class, array('required'=>false,'data_class'=>null));

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Limitless\KarhabtiBundle\Entity\Client'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Limitless_KarhabtiBundle_client';
    }


}
