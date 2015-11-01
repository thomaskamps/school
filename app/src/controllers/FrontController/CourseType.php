<?php
namespace FrontController;
use models;
use Silex\Application;
use Silex\ControllerProviderInterface;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
class CourseType { 
	function index($course_type, Application $app) {
			
    		$dql = "SELECT t FROM models\Course t WHERE t.id = $course_type";
		
    		$query = $app['orm.em']->createQuery($dql);
        
    		$objects = $query->getResult();

			return $app['twig']->render('exercise.twig', array(
                "data" => $objects[0],
			));
			
			
        }
}
?>