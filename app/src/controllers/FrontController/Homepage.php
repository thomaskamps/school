<?php
namespace FrontController;
use models;
use Silex\Application;
use Silex\ControllerProviderInterface;
//use Symfony\Component\HttpFoundation\Request;
//use Symfony\Component\HttpFoundation\Response;
class Homepage { 
	function index(Application $app) {
			
    		$dql = "SELECT t FROM models\Course t WHERE t.view_status = 5 ORDER BY t.title ASC";
		
    		$query = $app['orm.em']->createQuery($dql);
		
    		$objects = $query->getResult();
            
			return $app['twig']->render('home.twig', array(
                "courses" => $objects,
			));
			
			
        }
}
?>