<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=> 'Nom',
                'attr' =>[
                    'class' => 'form-control mt-3'
                ]
            ])
            ->add('prenom',TextType::class,[
                'label'=> 'Prénom',
                'attr' =>[
                    'class' => 'form-control mt-3'
                ]
            ])
            ->add('email',EmailType::class,[
                'label'=> 'Email',
                'attr' =>[
                    'class' => 'form-control mt-3'
                ]
            ])
            ->add('telephone',TextType::class,[
                'label'=> 'Téléphone',
                'attr' =>[
                    'class' => 'form-control mt-3'
                ]
            ])
            ->add('message',TextareaType::class,[
                'label'=> 'Message',
                'attr' =>[
                    'class' => 'form-control mt-3'
                ]
            ])
            ->add('estHumain',CheckboxType::class,[
                'label' => 'Je ne suis pas un robot',
                'required' => true
            ])
            ->add('submit',SubmitType::class,[
                'label'=> 'Envoyer',
                'attr' =>[
                    'class' => 'btn btn-primary'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
