<?php

namespace App\Form;

use App\Entity\Formateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomFormateur', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'row_attr' => ['class' => 'mb-2'],
                'label' => 'Nom :',
            ])
            ->add('prenomFormateur', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'row_attr' => ['class' => 'mb-2'],
                'label' => 'Prénom :'
            ])
            ->add('emailFormateur', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'row_attr' => ['class' => 'mb-2'],
                'label' => 'Email :'
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
            'data_class' => Formateur::class,
        ]);
    }
}
