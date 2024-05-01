<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Nom'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('subtitle', TextType::class, [
                'label' => 'Sous-titre',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Sous-titre'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Avis',
                'attr' => [
                    'class' => 'form-textarea',
                    'placeholder' => 'Avis'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer',
                'attr' => [
                    'class' => 'btn'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}
