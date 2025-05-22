<?php

namespace App\Form;

use App\Entity\Taskmaster;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Validator\Constraints\Choice;

class TaskmasterForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'In Progress' => 'in progress',
                    'Pending' => 'pending',
                    'Completed' => 'completed',
                ],
                'placeholder' => 'Select a status',
                'required' => true,
                'attr' => ['class' => 'form-select'],
                'constraints' => [
                    new Choice(['choices' => ['in progress', 'pending', 'completed']]),
                ],
            ])
            ->add('dueDate')
            ->add('save', SubmitType::class, [
                'label' => 'Create Task',
                'attr' => ['class' => 'btn btn-primary'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Taskmaster::class,
            'csrf_protection' => true, // Enables CSRF protection
            'csrf_field_name' => '_csrf_token', // Defines the CSRF field name
            'csrf_token_id' => 'task_form', // Unique token ID for this form
        ]);
    }
}
