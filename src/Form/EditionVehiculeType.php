<?php

namespace App\Form;

use App\Entity\Equipement;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class EditionVehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control'
                ]
            ])
            ->add('prix',NumberType::class,[
                'attr'=>[
                    'class'=> 'form-control'
                ],
                'constraints' => [
                    new GreaterThanOrEqual([
                        'value' => 1000,
                        'message' => 'Le prix ne peut pas être inférieur à 1000 €.',
                    ]),
                    new LessThanOrEqual([
                        'value' => 100000, // Remplacez par la valeur maximale souhaitée
                        'message' => 'Le prix ne peut pas dépasser 100000 €.',
                    ]),
                ],
            ])
            ->add('marque',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control'
                ]
            ])
            ->add('modele',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control'
                ]
            ])
            ->add('annee',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control'
                ],
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d{4}$/',
                        'message' => 'Le champ doit contenir exactement 4 chiffres.',
                    ]),
                ],
            ])
            ->add('kilometrage',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control'
                ]
            ])
            ->add('energie',ChoiceType::class, [
                'choices' => [
                    'ESSENCE' => 'ESSENCE',
                    'GASOIL' => 'GASOIL',
                    'GPL' => 'GPL',
                    'ELECTRIQUE' => 'ELECTRIQUE',
                ],
            ])
            ->add('boite',ChoiceType::class, [
                'choices' => [
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                ],
            ])
            ->add('couleur',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control'
                ]
            ])
            ->add('nbporte',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control'
                ],
                'constraints' => [
                    new Type([
                        'type' => 'numeric',
                        'message' => 'Le champ doit être un nombre.',
                    ]),
                ],
            ])
            ->add('nbplace',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control'
                ],
                'constraints' => [
                    new Type([
                        'type' => 'numeric',
                        'message' => 'Le champ doit être un nombre.',
                    ]),
                ],
            ])
            ->add('puissance',TextType::class,[
                'attr'=>[
                    'class'=> 'form-control'
                ],
                'label'=>'Puissance CV',
                'constraints' => [
                    new Type([
                        'type' => 'numeric',
                        'message' => 'Le champ doit être un nombre.',
                    ]),
                ],
            ])
            ->add('puissanceDin',TextType::class,[
                'label'=>'Puissance DIN',
                'attr'=>[
                    'class'=> 'form-control'
                ],
                'constraints' => [
                    new Type([
                        'type' => 'numeric',
                        'message' => 'Le champ doit être un nombre.',
                    ]),
                ],
            ])
            ->add('equipement', EntityType::class, [
                'class' => Equipement::class,
                'label'=> 'Equipements présents',
                'choice_label' => 'nom',
                'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
                    return $er->createQueryBuilder('e')
                        ->orderBy('e.nom', 'ASC');
                },
                'multiple' => true,
                'expanded' => true,
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'ENREGISTRER',
                'attr'=>[
                    'class'=> 'btn btn-primary',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}
