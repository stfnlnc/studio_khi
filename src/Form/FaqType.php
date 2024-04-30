<?php

namespace App\Form;

use App\Entity\Faq;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FaqType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('question', TextType::class, [
                'label' => 'Question',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Question'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('answer', TextareaType::class, [
                'label' => 'Réponse',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Réponse'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('category', ChoiceType::class, [
                'label' => 'Catégorie',
                'choices'  => [
                    'Général' => 'general',
                    'Branding & Logo' => 'branding',
                    'Webdesign & UI/UX Design' => 'webdesign',
                    'Site Web & Développement' => 'website'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'attr' => [
                    'class' => 'form-check'
                ],
                'placeholder' => false,
                'multiple' => false,
                'expanded' => true,
                'required' => true
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
            'data_class' => Faq::class,
        ]);
    }
}
