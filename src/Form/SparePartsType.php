<?php

namespace App\Form;

use App\Entity\SpareParts;
use App\Entity\Tech;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Tetranz\Select2EntityBundle\Form\Type\Select2EntityType;

class SparePartsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('techs', EntityType::class, [
                'class'        => Tech::class,
                'choice_label' => 'name',
                'label'        => 'choice techs',
                'expanded'     => false,
                'multiple'     => true,
                'attr'         => ['class' => 'form-control at-select2', 'size' => 30,],
            ])
            ->add('price')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SpareParts::class,
        ]);
    }
}
