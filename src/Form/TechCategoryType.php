<?php

namespace App\Form;

use App\Entity\TechCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TechCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('title')
            ->add('url')
            ->add('small_image_bin', FileType::class, ['label' => 'Изображение в категории', 'data_class' => null])
            ->add('side_bar_image_bin', FileType::class, ['label' => 'Изображение в сайдбаре', 'data_class' => null])
            ->add('content',TextareaType::class, ['attr' =>  ['class' => 'form-control html_redactor', 'rows' => 10, 'cols' => 30]])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TechCategory::class,
        ]);
    }
}
