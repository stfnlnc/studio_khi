<?php

namespace App\Form;

use App\Entity\PostTag;
use App\Entity\Tag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\AsciiSlugger;

class PostTagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Nom du tag'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ]
            ])
            ->add('slug', TextType::class, [
                'label' => 'Slug',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Slug'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('color', ChoiceType::class, [
                'choices' => [
                    'Sélectionner la couleur' => [
                        'Blanc' => '',
                        'Violet' => 'violet',
                        'Bleu' => 'blue',
                        'Vert' => 'green',
                        'Beige' => 'beige',
                    ]
                ],
                'label' => 'Couleur',
                'placeholder' => false,
                'attr' => [
                    'class' => 'form-input'
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
            ->addEventListener(FormEvents::PRE_SUBMIT, $this->autoSlug(...))
            ->addEventListener(FormEvents::POST_SUBMIT, $this->setDate(...))
        ;
    }

    public function setDate(PostSubmitEvent $event): void
    {
        $data = $event->getData();
        if(!($data instanceof PostTag)) {
            return;
        }
        $dateTime = new \DateTimeImmutable('Europe/Paris');
        $data->setUpdatedAt($dateTime);
        if(!$data->getId()) {
            $data->setCreatedAt($dateTime);
        }
    }

    public function autoSlug(PreSubmitEvent $event): void
    {
        $data = $event->getData();
        if(empty($data['slug'])) {
            $slugger = new AsciiSlugger();
            $data['slug'] = strtolower($slugger->slug($data['name']));
            $event->setData($data);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PostTag::class,
        ]);
    }
}
