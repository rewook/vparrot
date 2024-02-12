<?php

namespace App\Form;

use App\Entity\Commentaire;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commentaire',TextareaType::class,[
                'label'=> 'Commentaire'
            ])
            ->add('nom',TextType::class,[
                'label' => 'Nom'
            ])
            ->add('note',ChoiceType::class, [
                'choices' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                ],
                'label' => 'Choisissez une note de 1 à 5 sur 5',
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
            'data_class' => Commentaire::class,
        ]);
    }
}
