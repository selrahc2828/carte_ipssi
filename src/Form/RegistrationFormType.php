<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\{AbstractType, FormBuilderInterface};
use Symfony\Component\Form\Extension\Core\Type\{CheckboxType,PasswordType, RepeatedType, TextType, EmailType};
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\{IsTrue, Length, NotBlank};

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo', TextType::class, ['label' => "Pseudo : "])
            ->add('email', EmailType::class, ['label' => "Mail : "])
            ->add('password', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                ],
            ])
           /* ->add('password', RepeatedType::class, ['type' =>PasswordType::class,
                'first_options' => [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'label' => "Mot de passe : ",
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer un mot de passe',
                        ]),                    
                    ],
                ],
                'second_options' => [
                    // instead of being set onto the object directly,
                    // this is read and encoded in the controller
                    'label' => "Confirmation de Mot de passe : ",
                    'mapped' => false,
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Veuillez entrer une confirmation',
                        ]),
                    ],
                ],   
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
