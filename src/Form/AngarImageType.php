<?php

namespace App\Form;

use App\Entity\Angar;
use App\Entity\AngarImage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AngarImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            /*->add('name')
            ->add('name_md5')
            ->add('path')
            ->add('path_thumbnail')*/
            ->add('image', FileType::class, ['label' => 'Изображения', 'multiple' => true])
//            ->add('first')
            ->add('angar', EntityType::class, [
                'class' => Angar::class,
                'choice_label' => function ($angar) {
                    /**@var Angar $angar*/
                    return $angar->getId() . ', '.$angar->getWidth() . ' x ' . $angar->getLength() . ' - ' . $angar->getSquare() . ' м2, ' . $angar->getAddress()->getFullAddress();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AngarImage::class,
        ]);
    }
}
