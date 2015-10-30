<?php

namespace forms\type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('term1', 'number', array(
            'attr'=>array(
                'placeholder'=>'Term1...'
            )
            
            ))
            ->add('term2', 'number', array(
                        'attr'=>array(
                            'placeholder'=>'Term2...'
                        )
            
                        ))
            ->add('english_word', 'text', array(
                'attr'=>array(
                    'placeholder'=>'English word...'
                )
            ))
            ->add('file', 'file', array(
            "required" => false,
            "file_path" => UPLOAD_DIR,
            "file_name" => "path",
            'attr' => array(
                
                'data-id' => 'picture-filename'
            )))
            ->add('view_status', 'hidden', array(
                'data' => 5,
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'models\Exercise',
        ));
    }

    public function getName()
    {
        return 'exercise';
    }
}

?>