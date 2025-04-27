<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Por favor ingrese un nombre']),
                ],
                'attr' => ['placeholder' => 'Nombre del empleado'],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Por favor ingrese un email']),
                    new Email(['message' => 'El email {{ value }} no es válido']),
                ],
                'attr' => ['placeholder' => 'correo@ejemplo.com'],
            ])
            ->add('position', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Por favor ingrese un puesto']),
                ],
                'attr' => ['placeholder' => 'Puesto o cargo'],
            ])
            ->add('projects', EntityType::class, [
                'class' => Project::class,
                'choice_label' => function(Project $project) {
                    return $project->getNameProject() ? $project->getNameProject() : 'Proyecto #' . $project->getId();
                },
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'select-projects compact-select',
                    'data-placeholder' => 'Seleccionar proyectos',
                    'size' => 4 // Controla la altura visual mostrando 4 opciones a la vez
                ],
                'required' => false,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
