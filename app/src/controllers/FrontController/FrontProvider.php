<?php

namespace FrontController;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;

use OAuth\OAuth2\Service\Facebook;
use OAuth\Common\Storage\Session;
use OAuth\Common\Consumer\Credentials;

class FrontProvider implements ControllerProviderInterface
{

    public function connect(Application $app) {

        // creates a new controller based on the default route
        $front = $app['controllers_factory'];
        
        $front->get("/", 'FrontController\Homepage::index')->bind("homepage");
        $front->get("/{course_type}", 'FrontController\CourseType::index')->bind("course_type");
		  
        return $front;
    }
}
