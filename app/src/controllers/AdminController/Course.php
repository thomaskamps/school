<?php
namespace AdminController;

class Course extends AdminBase
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
    
    public function __construct()
    {
        $this->model = 'models\Course';
        $this->form = 'course';
        
        $this->overview_tpl = 'admin/default-overview.twig';
        $this->form_tpl = 'admin/default-edit.twig';
        $this->delete_tpl = "admin/default-edit.twig";
        
        $this->overview_route = "admin-course-list";
        $this->create_route = "admin-course-create";
        $this->edit_route = "admin-course-edit";
        $this->delete_route = "admin-course-delete";
    }
    
}


?>
