<?php

namespace App\Form;

use App\Entity\SpareParts;
use App\Entity\SparePartsImage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SparePartsImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class, ['label' => 'Изображение'])
            ->add('first')
            ->add('spare', EntityType::class, [
                'class' => SpareParts::class,
                'choice_label' => function ($spare) {
                    return $spare->getTitle();
                }
            ])
            ->add('first')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SparePartsImage::class,
        ]);
    }
}
