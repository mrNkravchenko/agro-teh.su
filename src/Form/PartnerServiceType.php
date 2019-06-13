<?php

namespace App\Form;

use App\Entity\PartnerService;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('url')
            ->add('image_bin', FileType::class, ['label' => 'Главное Изображение', 'data_class' => null])
            ->add('small_image_bin', FileType::class, ['label' => 'Изображение в категории', 'data_class' => null])
            ->add('price')
            ->add('short_name')
            ->add('short_description', TextareaType::class, ['attr' =>  ['class' => 'form-control html_redactor', 'rows' => 10, 'cols' => 30]])
            ->add('content', TextareaType::class, ['attr' =>  ['class' => 'form-control html_redactor', 'rows' => 10, 'cols' => 30]])
            ->add('save', SubmitType::class, ['label' => 'Сохранить']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PartnerService::class,
        ]);
    }
}
