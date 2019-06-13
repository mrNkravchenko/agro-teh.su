<?php

namespace App\Form;

use App\Entity\PartnerService;
use App\Entity\PartnerServiceImage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerServiceImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class, ['label' => 'Изображение', 'multiple' => true])
//            ->add('is_slider')
            ->add('service', EntityType::class, [
                'class' => PartnerService::class,
                'choice_label' => function ($service) {
                    return $service->getName();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PartnerServiceImage::class,
        ]);
    }
}
