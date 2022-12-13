<?php

namespace App\Form;

use App\Entity\Coach;
use App\Entity\Lesson;
use App\Entity\Location;
use App\Entity\Sport;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', EntityType::class,[
                'class' => Sport::class,
                'choice_label' => 'name',

            ])
            ->add('Start', DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
            ])
            ->add('end', DateTimeType::class, [
                'date_widget' => 'single_text',
                'time_widget' => 'single_text',
            ])
            ->add('NbPlace')
            ->add('background_color',ChoiceType::class,

                array(
                    'choices'=>array(
                        'jaune safran'=> '#EAC435' ,
                        'jaune vif'=> '#FCAB10',

                        'tarte orange'=> '#FB4D3D',
                        'Coquelicot '=> '#F15025',
                        'orange carotte '=> '#F18F01',

                        'bleue ébloui'=> '#345995',
                        'poudre bleue'=> '#A0D2DB',
                        'bleue saphire'=> '#006E90',

                        'Rouge rubis'=> '#CA1551',
                        'Rouge feu'=> '#E3655B',

                        'Vert Caraibes'=> '#03CEA4',
                        'Vert moyen'=> '#5B8C5A',
                        'Vert-'=> '#13EB73',
                        'Vert océan'=> '#48BF84',
                        'Vert émeraude'=> '#439775',
                        'Vert myrte'=> '#32746D',

                        'Violet'=> '#726DA8',
                        'Violet lilas'=> '#89608E',
                        'Violet sombre'=> '#623B5A',

                        'rose de chine'=> '#E072A4',
                        'rose clair'=> '#FFA5AB',
                        'rose lavande'=> '#D8A7CA',
                        'noir'=> 'black',
                    )
                ))
            ->add('AllDay', ChoiceType::class,
            array(
                'choices'=>array(
                    'non'=> 'false',
                    'oui'=> 'true'
                )

            ))
            ->add('border_color',ChoiceType::class,
                array(
                    'choices'=>array(
                        'jaune safran'=> '#EAC435',
                        'jaune vif'=> '#FCAB10',

                        'tarte orange'=> '#FB4D3D',
                        'Coquelicot '=> '#F15025',
                        'orange carotte '=> '#F18F01',

                        'bleue ébloui'=> '#345995',
                        'poudre bleue'=> '#A0D2DB',
                        'bleue saphire'=> '#006E90',

                        'Rouge rubis'=> '#CA1551',
                        'Rouge feu'=> '#E3655B',

                        'Vert Caraibes'=> '#03CEA4',
                        'Vert moyen'=> '#5B8C5A',
                        'Vert-'=> '#13EB73',
                        'Vert océan'=> '#48BF84',
                        'Vert émeraude'=> '#439775',
                        'Vert myrte'=> '#32746D',

                        'Violet'=> '#726DA8',
                        'Violet lilas'=> '#89608E',
                        'Violet sombre'=> '#623B5A',

                        'rose de chine'=> '#E072A4',
                        'rose clair'=> '#FFA5AB',
                        'rose lavande'=> '#D8A7CA',
                        'noir'=> 'black',
                    )

                ))
            ->add('text_color',ChoiceType::class,
                array(
                    'choices'=>array(
                        'jaune safran'=> '#EAC435',
                        'jaune vif'=> '#FCAB10',

                        'tarte orange'=> '#FB4D3D',
                        'Coquelicot '=> '#F15025',
                        'orange carotte '=> '#F18F01',

                        'bleue ébloui'=> '#345995',
                        'poudre bleue'=> '#A0D2DB',
                        'bleue saphire'=> '#006E90',

                        'Rouge rubis'=> '#CA1551',
                        'Rouge feu'=> '#E3655B',

                        'Vert Caraibes'=> '#03CEA4',
                        'Vert moyen'=> '#5B8C5A',
                        'Vert-'=> '#13EB73',
                        'Vert océan'=> '#48BF84',
                        'Vert émeraude'=> '#439775',
                        'Vert myrte'=> '#32746D',

                        'Violet'=> '#726DA8',
                        'Violet lilas'=> '#89608E',
                        'Violet sombre'=> '#623B5A',

                        'rose de chine'=> '#E072A4',
                        'rose clair'=> '#FFA5AB',
                        'rose lavande'=> '#D8A7CA',
                        'noir'=> 'black',
                    )

                ))
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
