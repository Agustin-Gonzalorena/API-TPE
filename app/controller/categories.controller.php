<?php
require_once './app/model/categories.model.php';
require_once './app/view/categories.view.php';

class categoriesController{
    private $model;
    private $view;

    function __construct(){
        $this->model=new categoriesModel;
        $this->view=new categoriesView;
    }

    function get($params=null){
        if($params==null){
            $categories=$this->model->getAll();
            $this->view->response($categories);
        }else{
            $id = $params[':ID'];
            $categories = $this->model->get($id);

            if ($categories)
                $this->view->response($categories);
            else 
                $this->view->response("La categoria con el id=$id no existe", 404);
        }

    }
}