<?php

namespace App\Form;

use App\Entity\Carte;
use App\Entity\Faction;
use App\Entity\Utilisateur;
use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

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
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Carte::class,
        ]);
    }
}
