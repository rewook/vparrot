<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label'=> 'Nom',
                'attr'=>[
                    'class'=> 'form-control'
                ]
            ])
            ->add('description', TextareaType::class,[
                'label'=> 'Description du service',
                'attr'=>[
                    'class'=> 'form-control'
                ]
            ])

            ->add('image',FileType::class,[
                'label' => 'Image du service',
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Attendu fichier  JPEG ou PNG ',
                    ]),
                    new NotBlank([
                        'message' => 'Le fichier doit être une image',
                    ]),
                ],
            ])
            ->add('submit',SubmitType::class,[
                'label'=>'AJOUTER',
                'attr'=>[
                    'class'=>'btn btn-primary'
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
