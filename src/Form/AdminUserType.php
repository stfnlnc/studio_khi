<?php

namespace App\Form;

use App\Entity\AdminUser;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Email'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Nom'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Prénom'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('job', TextType::class, [
                'label' => 'Poste',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Poste'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => 'Téléphone',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Téléphone'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
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
            'data_class' => AdminUser::class,
        ]);
    }
}
