<?php

namespace App\Form;

use App\Entity\Complectation;
use App\Entity\Tech;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ComplectationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')
            ->add('price')
            ->add('created')
            ->add('updated')
            ->add('tech', EntityType::class, [
                'class' => Tech::class,
                'choice_label' => function ($tech) {
                    return $tech->getName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Complectation::class,
        ]);
    }
}
