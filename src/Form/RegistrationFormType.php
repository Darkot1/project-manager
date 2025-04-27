<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Email;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor ingrese su nombre',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Su nombre debe tener al menos {{ limit }} caracteres',
                        'max' => 50,
                        'maxMessage' => 'Su nombre no puede tener más de {{ limit }} caracteres'
                    ])
                ],
                'attr' => [
                    'placeholder' => 'Ingrese su nombre completo',
                    'class' => 'form-control'
                ],
                'label' => 'Nombre completo'
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor ingrese un correo electrónico',
                    ]),
                    new Email([
                        'message' => 'El correo electrónico {{ value }} no es válido',
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'correo@ejemplo.com',
                    'class' => 'form-control'
                ],
                'label' => 'Correo electrónico'
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Debe aceptar los términos y condiciones para continuar.',
                    ]),
                ],
                'label' => 'Acepto los términos y condiciones',
                'attr' => ['class' => 'form-check-input'],
                'label_attr' => ['class' => 'form-check-label'],
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'placeholder' => 'Ingrese su contraseña',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Por favor ingrese una contraseña',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Su contraseña debe tener al menos {{ limit }} caracteres',
                        'max' => 4096,
                    ]),
                ],
                'label' => 'Contraseña'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
