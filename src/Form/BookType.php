<?php

use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class BookType extends \Symfony\Component\Form\AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options):void
    {
        $builder
            ->add('Title', TextType::class, [
                'label'=>'Titre',
                'attr'=>[
                    'placeholder'=>'Titre du livre'
                ]]
            )
            ->add('Author', TextType::class,[
                'label'=>'Auteur',
                'attr'=> ['placeholder'=>'Auteur du livre'],
                ])
            ->add('isbn', NumberType::class,
                [
                    'label'=>'ISBN',
                    'attr'=>['placeholder'=>'Numéro ISBN']
                    ])
            ->add('kind',TextType::class, [
                'label'=>'Genre',
                'attr'=>['placeholder'=>'genre du livre']
                ])
            ->add('save', SubmitType::class)
        ;
}
}