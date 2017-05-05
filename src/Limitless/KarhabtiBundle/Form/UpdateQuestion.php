<?php

namespace Limitless\KarhabtiBundle\Form;

use Limitless\KarhabtiBundle\Entity\Cours;
use Limitless\KarhabtiBundle\Entity\Question;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UpdateQuestion extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('contenue',TextType::class)
            ->add('categorie')
            ->add('Proposition1')
            ->add('Proposition2')
            ->add('Proposition3')
            ->add('repvrai')
            ->add('examen');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'Limitless_karhabtibundle_update_question';
    }


}
