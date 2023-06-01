<?php

namespace App\Form;

use App\Entity\Plat;
use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;

class PlatsFormType extends AbstractType
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
            ->add('description', options:[
                'attr' => [
                    'class' => ''
                ],
                'label' => 'Description', 
                'label_attr' => [
                    'class' => 'text-white'
                ]
            ])
            ->add('prix', MoneyType::class, options:[
                'attr' => [
                    'class' => ''
                ],
                'label' => 'Prix',
                'label_attr' => [
                    'class' => 'text-white'
                ],
                'divisor' => 100,
                'constraints' => [
                    new Positive(
                        message: 'Le prix ne peut être négatif'
                    )
                ]
            ])
            ->add('image',FileType::class, [
                'attr' => [
                    'class' => ''
                ],
                'label' => false,
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
                ]
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'attr' => [
                    'class' => 'form-control'
                ],
                'choice_label' => 'libelle',
                'label' => 'Catégorie', 
                'label_attr' => [
                    'class' => 'text-white'
                ],
                'query_builder' => function(CategorieRepository $cr)
                {
                    return $cr->createQueryBuilder('c')
                        ->orderBy('c.libelle', 'ASC');
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Plat::class,
        ]);
    }
}
