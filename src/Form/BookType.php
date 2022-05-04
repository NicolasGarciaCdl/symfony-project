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
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            ->add('Author', EntityType::class,[
                'label'=>'Auteur',
                'class'=> Author::class,
                'attr'=> ['placeholder'=>'Auteur du livre'],

            ])
            ->add('isbn', NumberType::class,
                [
                    'label'=>'ISBN',
                    'attr'=>['placeholder'=>'Numéro ISBN'],
                    'constraints' => [
                        new Length([
                            'min' => 10,
                            'max' => 13,
                            'minMessage' => 'Le ISBN est trop court',
                            'maxMessage' => 'Le ISBN est trop long'
                        ])
                    ],
                ])
            ->add('kinds',EntityType::class, [
                'label'=>'Genre',
                'class'=> Kind::class,
                'multiple'=>true,
                'expanded'=>true,
                'attr'=>['placeholder'=>'genre du livre']
            ])
            ->add('resume', TextareaType::class,[
                'label'=> 'Description',
                'attr' =>[
                    'placeholder'=>'description du livre'
                ]
            ])
            ->add('year', DateType::class, [
                'label'=> 'Date de Sortie',
                'widget'=>'single_text',
                'html5' => false,
                'attr' => [
                    'placeholder'=> 'Date du livre'
                ]
            ])
            ->add('coverImageFile', VichImageType::class,[
                'label' => 'Couverture du livre',
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
            'data_class' => Book::class,
        ]);
    }
}