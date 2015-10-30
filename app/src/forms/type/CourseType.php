<?php
namespace forms\type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CourseType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
  
        $builder
            ->add('title', 'text', array('attr' => array('class'=>'form-control')))
            ->add('level', 'text')
            ->add('exercise', 'collection', array(
                    'type' => new ExerciseType(), 
                    'options' => array('label' => false, 'attr'=>array('class'=>'form_collection_item clearfix')), 
                    'allow_add' => true,
                    'allow_delete' => true,
                    'attr'=>array(
                        'class'=>'picture_collection clearfix',
                        'type'=>'exercise',
                    )
                ))
            ->add('view_status', 'choice', array(
                    'choices' => array(5 => 'Actief', 2 => 'Niet Actief'),
                    'expanded' => false,
                    'attr' => array('class'=>'form-control')
                ))
        ;
                     
            
    }

    public function getName()
    {
        return 'course';
    }
    
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'models\Course',
        ));
    }
}