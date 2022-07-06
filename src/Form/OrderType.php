<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Carrier;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $options['user'];

        $builder
            ->add('addresses', EntityType::class, [
                'label' => 'Choisissez votre adresse de livraison',
                'attr' => [
                    'class' => 'text-gray-900 font-medium title-font tracking-wider text-sm'
                ],
                'required' => true,
                'class' => Address::class,
                'multiple' => false,
                'choices' => $user->getAddresses(),
                'expanded' => true
            ])
            ->add('carriers', EntityType::class, [
                'label' => 'Choisissez votre transporteur',
                'attr' => [
                    'class' => 'text-gray-900 font-medium title-font tracking-wider text-sm'
                ],
                'required' => true,
                'class' => Carrier::class,
                'multiple' => false,
                'expanded' => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider ma commande',
                'attr' => [
                    'class' => 'text-white w-full bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded text-lg mt-4'
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'user' => array()
        ]);
    }
}
