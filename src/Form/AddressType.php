<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nommez votre adresse'
                ]
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Votre prénom'
                ]
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Votre nom'
                ]
            ])
            ->add('company', TextType::class, [
                'required' => false,
                'attr' => [
                    'placeholder' => 'Votre nom société ( facultatif )',
                ]
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'placeholder' => 'Votre adresse, ex : 8 rue des lila'
                ]
            ])
            ->add('postal', TextType::class, [
                'attr' => [
                    'placeholder' => 'Votre code postal'
                ]
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'placeholder' => 'Votre ville'
                ]
            ])
            ->add('country', CountryType::class, [
                'attr' => [
                    'placeholder' => 'Votre pays'
                ]
            ])
            ->add('phone', TelType::class, [
                'attr' => [
                    'placeholder' => 'Votre numéro de téléphone'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Ajouter',
                'attr' => [
                    'class' => 'text-white w-1/2 bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg mt-4'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
