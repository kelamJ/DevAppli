<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CategoriesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', options:[
                'attr' => [
                    'class' => ''
                ],
                'label' => 'Nom', 
                'label_attr' => [
                    'class' => 'text-white'
                ]
            ])
            ->add('image',FileType::class, [
                'attr' => [
                    'class' => ''
                ],
                'label' => 'Image',
                'label_attr' => [
                    'class' => 'text-white'
                ],
                'multiple' => true,
                'mapped' => false,
                'required' =>false,
                'constraints' => [
                    new All(
                        new Image([
                            'maxWidth' => 1280,
                            'maxWidthMessage' => 'L\'image doit faire {{ max_width }} pixels de large au maximum'
                        ])
                    )
                ]
            ])
            ->add('active', options:[
                'label' => 'Disponibilité', 
                'label_attr' => [
                    'class' => 'text-white'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
}
