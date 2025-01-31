<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomStagiaire', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom :'
            ])
            ->add('prenomStagiaire', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom :'
            ])
            ->add('sexe', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Sexe :'
            ])
            ->add('dateNaissance', DateType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Date de naissance :'
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Ville :'
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Email :'
            ])
            ->add('telephone', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Téléphone :'
            ])
            ->add('sessions', EntityType::class, [
                'class' => Session::class,
                'choice_label' => 'nomSession',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'row_attr' => ['class' => 'checkbox-sessions-container'],
                'label' => 'Sélectionner les sessions : '
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'bs-addEdit'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
