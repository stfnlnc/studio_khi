<?php

namespace App\Form;

use App\DTO\ContactDTO;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class, [
                'empty_data' => '',
                'label' => 'Nom*',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Votre nom',
                ]
            ])
            ->add('firstname', TextType::class, [
                'empty_data' => '',
                'label' => 'Prénom*',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Votre prénom',
                ]
            ])
            ->add('email', EmailType::class, [
                'empty_data' => '',
                'label' => 'Email*',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Votre email',
                ]
            ])
            ->add('phone', TelType::class, [
                'empty_data' => '',
                'label' => 'Téléphone*',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Votre numéro de téléphone',
                ]
            ])
            ->add('message', TextareaType::class, [
                'empty_data' => '',
                'label' => 'Message',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Votre message',
                ],
                'required' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactDTO::class,
        ]);
    }
}
