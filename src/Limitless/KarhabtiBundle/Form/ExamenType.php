<?php

namespace Limitless\KarhabtiBundle\Form;

use Hshn\Base64EncodedFile\Form\Type\Base64EncodedFileType;
use Limitless\KarhabtiBundle\Entity\Cours;
use Limitless\KarhabtiBundle\Entity\Reponse;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExamenType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

        ->add('titre')
            ->add('typePermis')
        ->add('Question1',EntityType::class ,array(

            'class'=> 'LimitlessKarhabtiBundle:Question',
            'choice_label'=>'contenue',
        ))
        ->add('Question2',EntityType::class ,array(
            'class'=> 'LimitlessKarhabtiBundle:Question',
            'choice_label'=>'contenue',
        ))

        ->add('Question3',EntityType::class ,array(
            'class'=> 'LimitlessKarhabtiBundle:Question',
            'choice_label'=>'contenue',
        ))

        ->add('Question4',EntityType::class ,array(
            'class'=> 'LimitlessKarhabtiBundle:Question',
            'choice_label'=>'contenue',
        ))

        ->add('Question5',EntityType::class ,array(
            'class'=> 'LimitlessKarhabtiBundle:Question',
            'choice_label'=>'contenue',
        ))

        ->add('Question6',EntityType::class ,array(
            'class'=> 'LimitlessKarhabtiBundle:Question',
            'choice_label'=>'contenue',
        ))

        ->add('Question7',EntityType::class ,array(

            'class'=> 'LimitlessKarhabtiBundle:Question',
            'choice_label'=>'contenue',
        ))

        ->add('Question8',EntityType::class ,array(
            'class'=> 'LimitlessKarhabtiBundle:Question',
            'choice_label'=>'contenue',
        ))

        ->add('Question9',EntityType::class ,array(
            'class'=> 'LimitlessKarhabtiBundle:Question',
            'choice_label'=>'contenue',
        ))

        ->add('Question10',EntityType::class ,array(
            'class'=> 'LimitlessKarhabtiBundle:Question',
            'choice_label'=>'contenue',
        ))


        ->add('image',FileType::class, array(
            'data_class'  => null, ))


    ;
    }

    public static function getImageDataFromUrl($url)
    {
        $urlParts = pathinfo($url);
        $extension = $urlParts['extension'];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $base64 = 'data:image/' . $extension . ';base64,' . base64_encode($response);
        return $base64;

    }

    public function getName()
    {
        return 'responsable_question_Ajouter';
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'FSchubert\SiyabongaBundle\Entity\Image',
            )
        );
    }


    public function getDefaultOptions(array $options)
    {
        return array(   'data_class' => 'Limitless_karhabtibundle_examen',);
    }



    public  static function processImage(UploadedFile $uploaded_file)
    {
        $path='../../PIDev/web/images/upload/Test/images/';
        // $uploaded_file_info = pathinfo($uploaded_file->getClientOriginalName());
        $file_name=$uploaded_file->getClientOriginalName();
        $uploaded_file->move($path ,$file_name);
        return $file_name ;
    }

}
