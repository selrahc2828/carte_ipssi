<?php

namespace App\Form;

use App\Entity\{Carte, Faction, Utilisateur, Type};
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\{AbstractType, FormBuilderInterface};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CarteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('PV')
            ->add('armure')
            ->add('attaque')
            ->add('cout')
            /*->add('createur', EntityType::class, [
                'class' => Utilisateur::class,
                'choice_label' => function(Utilisateur $createur) {
                    return $createur->getUsername();
                },
            ])*/
            ->add('type', EntityType::class, [
                'class' => Type::class,
                'choice_label' => function(Type $type) {
                    return $type->getTitre();
                },
            ])
            ->add('faction', EntityType::class, [
                'class' => Faction::class,
                'choice_label' => function(Faction $faction) {
                    return $faction->getTitre();
                },
            ])
            ->add('image', FileType::class,[
                'label' => 'Image de la carte : ',
                'data_class' => null,
                "constraints" => [
                    new File([
                        "mimeTypes" => "image/*",
                        'mimeTypesMessage' => "Merci de fournir une image :p",
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carte::class,
        ]);
    }
}
