<?php

namespace App\Form;


use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PropertyFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '5',
                    'maxlength' => '255'
                ],
                'label' => 'Titre de l\'annonce :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 5, 'max' => 255]),
                    new Assert\NotBlank()
                ]
            ])


            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '5',
                    'maxlength' => '255'
                ],
                'label' => 'Description de l\'annonce :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 5, 'max' => 255]),
                ]
            ])


            ->add('surface', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Surface du bien :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\GreaterThan(5),
                    new Assert\LessThan(400)
                ]
            ])


            ->add('rooms', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nombre de pièce :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive(),
                    new Assert\GreaterThan(1)
                ]
            ])


            ->add('bedrooms', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Nombre de chambre :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive()
                ]
            ])


            ->add('floor', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Numéros d\'étage :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive()
                ]
            ])


            ->add('heat', ChoiceType::class, [
                'choices' => [
                    'Electrique' => 1,
                    'Gaz' => 2,
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Type de chauffage :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive()
                ]
            ])


            ->add('price', MoneyType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Prix ',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive()
                ]
            ])


            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '5',
                    'maxlength' => '255'
                ],
                'label' => 'Ville :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 5, 'max' => 255]),
                    new Assert\NotBlank()
                ]
            ])


            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlength' => '5',
                    'maxlength' => '255'
                ],
                'label' => 'Adresse :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Length(['min' => 5, 'max' => 255]),
                    new Assert\NotBlank()
                ]
            ])

            ->add('postal_code', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Code postal :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'constraints' => [
                    new Assert\Positive()
                ]
            ])

            ->add('imageFile', VichImageType::class, [
                'label' => 'Image du bien',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])

            ->add('sold', CheckboxType::class, [
                'label' => 'Vendu :',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    "class" => 'btn btn-success',
                    "class" => 'form-control'
                ],
                'label' => 'Ajouter la propriétée',

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }
}
