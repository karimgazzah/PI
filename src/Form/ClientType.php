<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter your email'],
            ])
            ->add('password', PasswordType::class, [
                'label' => 'Password',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter password'],
            ])
            ->add('retypepassword', PasswordType::class, [
                'label' => 'Re-Type Password',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Re-type password'],
            ])
            ->add('casesNumber', NumberType::class, [  // Using camelCase to match the entity
                'label' => 'Cases Number',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter number of cases'],
                'required' => false,
            ])
            ->add('moreInformation', TextareaType::class, [ // Updated to match entity property name
                'label' => 'More Information',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter any additional information'],
            ])
            ->add('number', TextType::class, [
                'label' => 'Phone Number',
                'attr' => ['class' => 'form-control', 'placeholder' => 'Enter phone number', 'pattern' => '[0-9]*', 'inputmode' => 'numeric'],
            ]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
