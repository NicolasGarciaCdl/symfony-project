<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class,[
                'label' => 'Adresse de Messagerie',
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Role de l\'utilisateur',
                'choices' =>[
                    'utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN'
                ],
                    'expanded' => true,
                    'multiple' => true,
            ])
            ->add('isVerified')

            ->add('firstname', TextType::class,[
                'label' => 'prénom'
            ])
            ->add('lastname', TextType::class,[
                'label' => 'nom'
            ])
            ->add('birthDate', DateType::class, [
                'label' => 'date de naissance',
                'widget' => 'single_text'

            ])
            ->add('userImageFile', VichImageType::class,[
                'label' => 'Image de l\'utilisateur',
                'required'=> false
            ])
            ->add('city', TextType::class,[

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
