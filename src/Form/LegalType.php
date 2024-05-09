<?php

namespace App\Form;

use App\Entity\Legal;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LegalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('legal_notice', TinymceType::class, [
                'label' => 'Mentions Légales',
                'attr' => [
                    'class' => 'form-textarea',
                    'placeholder' => 'Mentions Légales'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('privacy_policy', TinymceType::class, [
                'label' => 'Politique de Confidentialité',
                'attr' => [
                    'class' => 'form-textarea',
                    'placeholder' => 'Politique de Confidentialité'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('cookies', TinymceType::class, [
                'label' => 'Cookies',
                'attr' => [
                    'class' => 'form-textarea',
                    'placeholder' => 'Cookies'
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
            'data_class' => Legal::class,
        ]);
    }
}
