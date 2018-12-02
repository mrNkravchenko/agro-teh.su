<?php

namespace App\Form;

use App\Entity\Angar;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AngarType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('width')
            ->add('length')
            ->add('square')
            ->add('costumer')
            ->add('address_id')
            ->add('created')
            ->add('updated')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Angar::class,
        ]);
    }
}
