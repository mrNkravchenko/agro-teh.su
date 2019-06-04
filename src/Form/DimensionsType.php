<?php

namespace App\Form;

use App\Entity\Dimensions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DimensionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('length')
            ->add('width')
            ->add('height')
            ->add('weight')
            ->add('volume')
            ->add('tech')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Dimensions::class,
        ]);
    }
}
