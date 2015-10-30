<?php

namespace AdminController;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Cocur\Slugify\Slugify;

class AdminBase
{
    public $model;
    public $form;
    public $has_slug;
    
    public $overview_tpl;
    public $form_tpl;
    public $delete_tpl;

    public $overview_route;
    public $create_route;
    public $edit_route;
    public $delete_route;
    
    public $select_dql;
    
    public function get_name($classname) {
        if (preg_match('@\\\\([\w]+)$@', $classname, $matches)) {
            $classname = $matches[1];
        }

        return $classname;
    }
    
    public function overview(Request $request, Application $app) {
		
		if(!empty($this->select_dql)) {
			$dql = $this->select_dql;
		} else {
			$dql = "SELECT t FROM $this->model t WHERE t.view_status != 1 ";
		}
		
		$query = $app['orm.em']->createQuery($dql);
		
		$objects = $query->getResult();
		
        $viewdata = array(
            'title' 		=> $this->get_name($this->model) . 's',
			'overview_route' => $this->overview_route,
            'create_route' 	=> $this->create_route,
            'edit_route' 	=> $this->edit_route,
            'delete_route' 	=> $this->delete_route,
            'objects' 		=> $objects,
            'form_type'     => $this->get_name($this->model)

        );

        return $app["twig"]->render($this->overview_tpl, $viewdata);
    }
    
    public function form(Request $request, Application $app, $slug = NULL) {
        
        $viewdata = array();
        $viewdata['title'] = $this->get_name($this->model) . "_edit";
        $viewdata['overview_route'] = $this->overview_route;
        $viewdata['form_type'] = $this->get_name($this->model);

        $find = array('id' => $slug);
        $object = $app['orm.em']->getRepository($this->model)->findOneBy($find);
        
        if(empty($object)) {
            //create new article
            // $viewdata['title'] = get_class($this->str_singular . "_create";
            $object = new $this->model;
            $object->setViewStatus(5);
            $object->setPubDate(new \DateTime("now"));
            $viewdata['title'] = $this->get_name($this->model) . "_create";
        }
        
        $form = $this->buildForm($app, $object);
        
        //echo "<pre>";
        
        $form->handleRequest($request);
        //\Doctrine\Common\Util\Debug::dump($form->getData());
        //die();
        
        if ($form->isValid()) {
            
            $this->saveData($request, $app, $form);
            
            return $app->redirect($app["url_generator"]->generate($this->overview_route));
        }

        $formView = $form->createView();
        
        // $formView->offsetGet('pictures')->set('full_name', 'form[pictures][]');

        $viewdata['form'] = $formView;

        return $app["twig"]->render($this->form_tpl, $viewdata);

    }
    
    public function buildForm($app, $object) {
        
        if (isset($this->form)) {
 
            $form = $app['form.factory']->createBuilder($this->form, $object)->getForm();
            
        } else {
            $form = $app['form.factory']->createBuilder('form',$object)
                ->add('title')
                ->add('slug')
                ->getForm();
        }
        return $form;
    }
    
    public function saveData(Request $request, Application $app, $form) {
		$object = $form->getData();
        
		if($this->has_slug == true) {
            $slugify = new Slugify();
	       
	        if($object->getSlug() === null) {
                $current_id = $object->getId();
	            $slug = \AdminController\General::unique_slug($slugify->slugify((string) $object), $this->model, $app['orm.em'], 0, $current_id);
	            $object->setSlug($slug);
                
                
	        }
            else {
                $current_id = $object->getId();
	            $slug_input = $object->getSlug();
                $temp_slug = $slugify->slugify($slug_input);
                $slug = \AdminController\General::unique_slug($temp_slug, $this->model, $app['orm.em'], 0, $current_id);
                $object->setSlug($slug);   
            }
		}
        
		$object->setChgDate(new \DateTime("now"));
        
        $app['orm.em']->persist($object);
        $app['orm.em']->flush();
    }
    
    public function delete (Request $request, Application $app, $slug) {
        $viewdata['overview_route'] = $this->overview_route;
        $find = array('id' => $slug);
        //print_r($find)
        $object = $app['orm.em']->getRepository($this->model)->findOneBy($find);
        
        if(empty($object)) {
            $app->abort(404, 'No ' . $this->get_name($this->model) . ' by that id');
        } 

        $form = $app['form.factory']->createBuilder('form', $object)->getForm();
        
        $form->handleRequest($request);

        if($form->isValid()) {
            $object =  $form->getData();
            $object->setViewStatus(1);
            $object->setChgDate(new \DateTime("now"));
            $app['orm.em']->persist($object);
			
			// $app['orm.em']->remove($object);
            $app['orm.em']->flush();
            
            return $app->redirect($app["url_generator"]->generate($this->overview_route));
        }
        $viewdata = array("title" => $this->get_name($this->model) . "_delete", 
                            "object" => $object,
                            "form" => $form->createView(),
                            'overview_route' => $this->overview_route,
                            'form_type' => $this->get_name($this->model));
                            
        return $app["twig"]->render($this->delete_tpl, $viewdata);
    }
    
}