<?php

namespace App\Form;

use App\Entity\Ouverture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OuvertureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('jour',TextType::class,[
                'attr'=>[
                    'readonly'=>'readonly'
                ]
            ])
            ->add('hdmatin',TimeType::class,[
                'label'=>'Début matin'
            ])
            ->add('hfmatin',TimeType::class,[
                'label'=>'Fin matin'
            ])
            ->add('hdapresmidi',TimeType::class,[
                'label'=>'Début après-midi'
            ])
            ->add('hfapresmidi',TimeType::class,[
                'label'=>'Fin après-midi'
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'ENREGISTRER'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ouverture::class,
        ]);
    }
}
