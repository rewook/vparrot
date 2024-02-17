<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditionServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('nom',TextType::class,[
                'label' => 'Nom',
                'attr'=>[
                    'class'=> 'form-control'
                ]
            ])
            ->add('description',TextareaType::class,[
                'label'=> 'Description',
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'MODIFIER',
                'attr'=>[
                    'class'=> 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
