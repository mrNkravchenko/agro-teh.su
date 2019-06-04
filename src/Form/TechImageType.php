<?php

namespace App\Form;

use App\Entity\Tech;
use App\Entity\TechImage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TechImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('image', FileType::class, ['label' => 'Изображение', 'multiple' => true])
//            ->add('is_slider')
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
            'data_class' => TechImage::class,
        ]);
    }
}
