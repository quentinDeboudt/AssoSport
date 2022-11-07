<?php

namespace App\Form;

use App\Entity\Coach;
use App\Entity\Lesson;
use App\Entity\Location;
use PhpParser\Node\Scalar\String_;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('StartTime', DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
            ])
            ->add('EndTime', DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
            ])
            ->add('NbPlace')
            ->add('background_color', ColorType::class)
            ->add('All_day')
            ->add('border_color', ColorType::class)
            ->add('text_color', ColorType::class)
            ->add('Location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name',


            ])
            ->add('Coach' ,EntityType::class, [
                'class' => Coach::class,
                'choice_label' => 'name',

            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
