<?php

namespace App\Form;

use App\Entity\AngarImage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AngarImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('name_md5')
            ->add('path')
            ->add('path_thumbnail')
            ->add('first')
            ->add('angar')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AngarImage::class,
        ]);
    }
}
