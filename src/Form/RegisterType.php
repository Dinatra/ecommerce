<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30,
                ]),
                'error_bubbling' => true,
                'required' => true,
            ])
            ->add('lastname', TextType::class, [
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30,
                ]),
                'error_bubbling' => true,
                'required' => true,
            ])
            ->add('login', TextType::class, [
                'error_bubbling' => true,
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 30,
                ]),
                'error_bubbling' => true,
                'required' => true,
            ])
            ->add('password', RepeatedType::class, [
                'constraints' => new Length(6, 6),
                'error_bubbling' => true,
                'type' => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique.',
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => array(
                        'class' => 'w-full bg-white rounded border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out'
                    )],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => array(
                        'class' => 'w-full bg-white rounded border border-gray-300 focus:border-green-500 focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out'
                    )],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
