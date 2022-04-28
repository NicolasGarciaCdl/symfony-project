<?php
namespace App\Form;

use App\Controller\LuckyController;
use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\Length;

class BookType extends AbstractType
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
                    'attr'=>['placeholder'=>'Numéro ISBN'],
                    'constraints'=> [new Length([
                        'min' => 10,
                        'max'=>13,
                        'minMessage'=>'L\'ISBN est trop court!',
                        'maxMessage' => 'L\'ISBN est trop long!'
                    ])]
                ])
            ->add('kind',TextType::class, [
                'label'=>'Genre',
                'attr'=>['placeholder'=>'genre du livre']
            ])
            ->add('save', SubmitType::class,[
                    'attr'=> [
                        'class' =>'btn btn-success'
                    ]]
            )
        ;


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}