<?php
/**
 * Created by PhpStorm.
 * User: nikita
 * Date: 25.10.18
 * Time: 23:11
 */

namespace App\Form;



use App\Entity\Dimensions;
use App\Entity\Performance;
use App\Entity\TechCategory;

use App\Repository\TechCategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class TechType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => TechCategory::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ])
            ->add('url')
            ->add('title')
            ->add('image_bin', FileType::class, ['label' => 'Главное Изображение', 'data_class' => null])
            ->add('small_image_bin', FileType::class, ['label' => 'Изображение в категории', 'data_class' => null])
            ->add('mng_image_bin', FileType::class, ['label' => 'Изображение в многограннике', 'data_class' => null])
            ->add('name')
            ->add('short_name')
            ->add('price')
            ->add('description', TextareaType::class, ['attr' =>  ['class' => 'form-control html_redactor', 'rows' => 10, 'cols' => 30]])
            ->add('manual', TextareaType::class, ['attr' =>  ['class' => 'form-control html_redactor', 'rows' => 10, 'cols' => 30]])
            ->add('performance', TextareaType::class, ['attr' =>  ['class' => 'form-control', 'rows' => 10, 'cols' => 30]])
            ->add('dimentions', DimensionsType::class)
//            ->add('dimentions')
            ->add('save', SubmitType::class);
    }

}