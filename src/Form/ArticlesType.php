<?php

namespace App\Form;

use App\Entity\Articles;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'Заоголовок'])
            ->add('name', TextType::class, ['label' => 'Название'])
            ->add('image_bin', FileType::class, ['label' => 'Изображение', 'data_class' => null])
            ->add('description', TextareaType::class, ['label' => 'Короткое описание', 'attr' => ['class' => 'form-control', 'rows' => 10, 'cols' => 30]])
            ->add('content', TextareaType::class, ['label' => 'Контент', 'attr' => ['class' => 'form-control html_redactor', 'rows' => 10, 'cols' => 30]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
