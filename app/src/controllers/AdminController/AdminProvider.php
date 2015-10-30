<?php
namespace AdminController;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
		
		// creates a new controller based on the default route
        $admin = $app['controllers_factory'];
        
		$app->get('/admin', function () use ($app) {
			return $app->redirect('admin/course');
		});
        $this->createRoutes($admin, 'course', 'AdminController\Course');
        
        return $admin;
    }
    
    public function createRoutes($route, $name, $controller) {
        $route->get("/$name", "$controller::overview")->bind("admin-$name-list");
        $route->match("/$name/create", "$controller::form")->bind("admin-$name-create");
        $route->match("/$name/edit/{slug}", "$controller::form")->bind("admin-$name-edit");
        $route->match("/$name/delete/{slug}", "$controller::delete")->bind("admin-$name-delete");
    }
}
?>