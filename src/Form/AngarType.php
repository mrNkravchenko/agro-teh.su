<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Angar;
use App\Entity\Costumer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('costumer', EntityType::class, [
                'class' => Costumer::class,
                'choice_label' => function ($costumer) {
                    return $costumer->getTitle() . ' ' . $costumer->getInn();
                }
            ])
            ->add('address', EntityType::class, [
                'class' => Address::class,
                'choice_label' => function ($address) {
                    return $address->getFullAddress();
                }
            ])
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
