<?php

namespace AppBundle\Form;

use AppBundle\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('difficulty', HiddenType::class, $this->sliderOptions())
            ->add('startTime', DateType::class, $this->datePickerOptions())
            ->add('priority', HiddenType::class, $this->sliderOptions())
            ->add('deadline', DateType::class, $this->datePickerOptions())
            ->add(
                'endTime',
                DateType::class,
                array_merge(["required" => false], $this->datePickerOptions())
            )
            ->add(
                'status',
                ChoiceType::class,
                ['choices' => array_merge(["-- Status --" => null], Task::statusMap())]
            )
            ->add('parent', null, ["required" => false])
            ->add('categories')
            ->add('tags');
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Task'
        ));
    }

    private function sliderOptions()
    {
        return [
            "attr" => ["class" => "slider"]
        ];
    }

    private function datePickerOptions()
    {
        return [
            "widget" => "single_text",
            "attr" => ["class" => "datepicker"],
            "html5" => false
        ];
    }
}
