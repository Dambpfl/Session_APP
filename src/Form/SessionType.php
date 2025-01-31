<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomSession', TextType::class, [
                'row_attr' => ['class' => 'mb-2'],
                'label' => 'Nom :'
            ])
            ->add('place', IntegerType::class, [
                'row_attr' => ['class' => 'mb-2'],
                'label' => 'Nombre de places :'
            ])
            ->add('dateDebut', DateType::class, [
                'row_attr' => ['class' => 'mb-2'],
                'label' => 'Date de début :'
            ])
            ->add('dateFin', DateType::class, [
                'row_attr' => ['class' => 'mb-2'],
                'label' => 'Date de fin :'
            ])

            ->add('formateur', EntityType::class, [
                'class' => Formateur::class,
                'choice_label' => 'nomFormateur',
                'row_attr' => ['class' => 'mb-2'],
                'label' => 'Formateur : '
            ])
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'nomFormation',
                'row_attr' => ['class' => 'mb-2'],
                'label' => 'Formation : '
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
            'data_class' => Session::class,
        ]);
    }
}
