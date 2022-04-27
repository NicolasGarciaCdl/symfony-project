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
            ->add('Title', TextType::class)
            ->add('Author', TextType::class)
            ->add('isbn', NumberType::class)
            ->add('kind',TextType::class)
            ->add('save', SubmitType::class)
        ;
}
}