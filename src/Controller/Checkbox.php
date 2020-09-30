<?php


namespace App\Controller;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class Checkbox extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

      // Employment
     ->add('employ', ChoiceType::class, array(
        'mapped' => false,
        'required' => false,
        'expanded' => true,
        'multiple' => true,
        'label' => 'Employment',
        'choices' => array(
            'I have a job. # of hours/week:' => 'have_job',
            'I am work study eligible' => 'work_study',
            'I need assistance in finding a job' => 'find_work',
            'I need to learn interviewing skills' => 'interview',
            'I have no employment needs at this time' => 'no_needs',
            'I volunteer for a non-profit organization' => 'non_profit',
            'I need assistance with my resume' => 'resume',
            'I need assistance finding an internship' => 'intern',
            'I am undecided about my career or major' => 'major',
            'Other:' => 'other',
        ),
    ));

}
}