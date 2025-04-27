<?php

namespace App\Form;

use App\Entity\Employee;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameProject', TextType::class, [
                'constraints' => [
                    new NotBlank(['message' => 'Por favor ingrese un nombre para el proyecto']),
                ],
                'attr' => [
                    'placeholder' => 'Nombre del proyecto',
                    'class' => 'form-control'
                ],
                'label' => 'Nombre del Proyecto'
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
                'label' => 'Fecha de Inicio'
            ])
            ->add('endDate', DateType::class, [
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
                'required' => false,
                'label' => 'Fecha de Finalización'
            ])
            ->add('Employees', EntityType::class, [
                'class' => Employee::class,
                'choice_label' => function(Employee $employee) {
                    return $employee->getName() ? $employee->getName() : 'Empleado #' . $employee->getId();
                },
                'multiple' => true,
                'expanded' => false,
                'attr' => [
                    'class' => 'form-select compact-select',
                    'data-placeholder' => 'Seleccionar empleados',
                    'size' => 4
                ],
                'required' => false,
                'by_reference' => false,
                'label' => 'Empleados'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'project_item',
        ]);
    }
}
