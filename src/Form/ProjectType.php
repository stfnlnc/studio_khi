<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\AsciiSlugger;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Nom du projet'
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
            ->add('excerpt', TextareaType::class, [
                'label' => 'Extrait',
                'attr' => [
                    'class' => 'form-textarea',
                    'placeholder' => 'Extrait haut de page'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('title', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Titre du projet'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'attr' => [
                    'class' => 'form-textarea',
                    'placeholder' => 'Description du projet'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('image', FileType::class, [
                'label' => '+ Ajouter une image',
                'multiple' => false,
                'mapped' => false,
                'label_attr' => [
                    'class' => 'form-input form-file'
                ],
                'required' => false
            ])
            ->add('images', FileType::class, [
                'label' => '+ Ajouter des images',
                'multiple' => true,
                'mapped' => false,
                'label_attr' => [
                    'class' => 'form-input form-file'
                ],
                'required' => false
            ])
            ->add('date', TextType::class, [
                'label' => 'Date',
                'attr' => [
                    'class' => 'form-input',
                    'placeholder' => 'Date du projet'
                ],
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'required' => false
            ])
            ->add('tag', EntityType::class, [
                'label' => 'Tags',
                'label_attr' => [
                    'class' => 'form-label'
                ],
                'class' => Tag::class,
                'choice_label' => 'name',
                'attr' => [
                  'class' => 'form-check'
                ],
                'multiple' => true,
                'expanded' => true,
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
        if(!($data instanceof Project)) {
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
            'data_class' => Project::class
        ]);
    }
}
