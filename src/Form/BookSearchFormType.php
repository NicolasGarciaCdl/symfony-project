<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Kind;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class BookSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->setMethod('GET')
            ->add('title', TextType::class, [
                    'label'=>'Titre',
                    'required' => false
                ])
            ->add('author', EntityType::class,[
                'label'=>'Auteur',
                'class'=> Author::class,
                'required' => false
            ])
            ->add('isbn', NumberType::class,
                [
                    'label'=>'ISBN',
                    'required' => false
                ])
            ->add('kinds',EntityType::class, [
                'label'=>'Genre',
                'class'=> Kind::class,
                'placeholder' => "--Sélectionnez--",
                'required' => false
            ])
            ->add('resume', TextareaType::class,[
                'label'=> 'Description',
                'required' => false
            ])
            ->add('year', DateType::class, [
                'label'=> 'Date de Sortie',
                'widget'=>'single_text',
                'html5' => false,
                'required' => false
            ])
            ->add('search', SubmitType::class,[
                    'attr'=> [
                        'class' =>'btn btn-success'
                    ],
                'label'=> 'Rechercher'

        ]);
    }
}