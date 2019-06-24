<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Costumer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CostumerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['attr' => ['class' => 'form-control'], 'label' => 'Введите название контрагента'])
            ->add('inn',NumberType::class, ['attr' => ['class' => 'form-control'], 'label' => 'Введите ИНН контрагента'])
            ->add('contacts', TextType::class, ['attr' => ['class' => 'form-control'], 'label' => 'Введите контактные данные контрагента'])
            ->add('email', TextType::class, ['attr' => ['class' => 'form-control', 'type' => 'email'], 'label' => 'Введите email контрагента'])
            ->add('phone', TextType::class, ['attr' => ['class' => 'form-control', 'placeholder' => '+79000000000'], 'label' => 'Введите телефон контрагента'])
            ->add('address', EntityType::class, [
                'class' => Address::class,
                'choice_label' => function ($address) {
                    return $address->getFullAddress();
                },
                'label' => 'Введите адрес контрагента'
            ])
            ->add('save', SubmitType::class, ['label' => 'Сохранить']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Costumer::class,
        ]);
    }
}
