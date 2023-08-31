<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->remove('roles')
            ->remove('password')
            ->add('plainPassword', RepeatedType::class,[
                'type'=>PasswordType::class,
                'required'=>false,
                'first_options'=>['label'=>'Mot de passe'],
                'second_options'=>['label'=>'Confirmez votre mot de passe'],
                'mapped'=>false,
                'help'=>'Le mot de passe doit contenir 6 caractères minimum.'
            ])
            ->add('nom')
            ->add('prenom')
            ->add('adresse1')
            ->add('adresse2')
            ->add('codePostal')
            ->add('ville')
            ->add('pays', CountryType::class,[
                'preferred_choices'=>['SN']
            ])
            ->add('tel')
            ->remove('isVerified')
            ->add('modifier',SubmitType::class,["attr"=>["class"=>"btn btn-dark"]])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
