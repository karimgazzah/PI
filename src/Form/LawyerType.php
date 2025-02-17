<?php
namespace App\Form;

use App\Entity\Lawyer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class LawyerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class)
            ->add('password', PasswordType::class)  // Make the password field hidden
            ->add('retypepassword', PasswordType::class)  // Make the retype password field hidden
            ->add('code', TextType::class)
            ->add('location', TextType::class)
            ->add('number', NumberType::class, [
                'attr' => [
                    'pattern' => '[0-9]*',  // Only numbers allowed
                    'inputmode' => 'numeric'  // Mobile optimization (number keypad)
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lawyer::class,
        ]);
    }
}

