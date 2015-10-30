<?php
namespace forms;

use Symfony\Component\Form\AbstractExtension;

class TypesExtension extends AbstractExtension
{
    var $em;
    
    public function __construct($em)
    {
        $this->em = $em;
    }

    protected function loadTypes()
    {
        return array(
            new type\CourseType($this->em),
            new type\ExerciseType($this->em),
        );

    }

}