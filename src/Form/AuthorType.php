<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Country;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class AuthorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr'=> [
                    'placeholder' => 'Prénom de l\'auteur'
                ]
            ])
            ->add('lastname',TextType::class , [
                'label' => 'Nom',
                'attr'=> [
                    'placeholder' => 'Nom de l\'auteur'
                ]
            ])
            ->add('birthdate', DateType::class,[
                'label' => 'Date de Naissance',
                'widget'=> 'single_text',
                'attr'=> [
                    'placeholder' => 'Date de naissance de l\'auteur'
                ]
            ])
            ->add('country', EntityType::class, [
                'label' => 'pays',
                'class' => Country::class,
                'attr'=> ['placeholder'=>'Pays de l\'Auteur'],
            ])
            ->add('authorImageFile', VichImageType::class,[
                'label' => 'Image de l\'auteur',
                'required'=> false
            ])
            ->add('save', SubmitType::class,[
                'attr'=> [
                    'class' =>'btn btn-success'
                ],
                'label' => 'Enregistrer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Author::class,
        ]);
    }
}
