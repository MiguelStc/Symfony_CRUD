<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('supplier')
            ->add('dangerIcon' ,ChoiceType::class,[
                'choices'=>[
                'SGH01'=>'SGH01',
                'SGH02'=>'SGH02',
                'SGH03'=>'SGH03',
                'SGH04'=>'SGH04',
                'SGH05'=>'SGH05',
                'SGH06'=>'SGH06',
                'SGH07'=>'SGH07',
                'SGH08'=>'SGH08',
                'SGH09'=>'SGH09'
            ],

            ])
            ->add('amount')
            ->add('location',ChoiceType::class,[
                'choices'=>[

                    'Bloc1'=>'Bloc1',
                    'Bloc2'=>'Bloc2',
                    'Bloc3'=>'Bloc3',
                    'Bloc4'=>'Bloc4',
                    'Bloc5'=>'Bloc5',
                    'Bloc6'=>'Bloc6',
                    'Bloc7'=>'Bloc7',
                    'Bloc8'=>'Bloc8',
                    'Bloc9'=>'Bloc9',
                ],
            ])
            ->add('save', SubmitType::class,['label'=> 'Envoyer']);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}
