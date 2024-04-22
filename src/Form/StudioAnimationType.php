<?php

namespace App\Form;

use App\Entity\Anime;
use App\Entity\StudioDanimation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class StudioAnimationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomStudio', TextType::class,[
                'label'=>'Nom du sudio d\'animation',
                'attr'=>[
                    "placeholder"=>"saisir le nom du studio d'animation"
                ]
            ])
            ->add('Anime', EntityType::class, [
                'class'=>Anime::class,
                'choice_label'=>'nom',
                'multiple'=>true, 
                'by_reference'=>false,
                'expanded'=>true

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StudioDanimation::class,
        ]);
    }
}
