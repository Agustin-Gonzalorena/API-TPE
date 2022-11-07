<?php
require_once './app/model/comments.model.php';
require_once './app/model/products.model.php';
require_once './app/view/api.view.php';
require_once './app/helpers/auth.helper.php';

class commentsController{
    private $model;
    private $productModel;
    private $view;
    private $data;
    private $helper;

    function __construct(){
        $this->model=new commentsModel();
        $this->productModel= new productsModel();
        $this->view = new apiView();
        $this->helper=new authHelper();
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    function get($param=null){
        if(count($_GET)==1){
            $comments=$this->model->getAll();
            $this->view->response($comments);
        }elseif(count($_GET)==2){
            if(empty($_GET['id']) && empty($_GET['user'])){
                $this->view->response("Parametro GET incorrecto",400);
            }else{
                if(isset($_GET['id'])){
                    $productId=$_GET['id'];
                    $comments=$this->model->getByProduct($productId);
                    if(empty($comments)){
                        $this->view->response("No se encuentran comentarios en este producto",404);
                        exit();
                    }
                    $this->view->response($comments);
                    
                }elseif(isset($_GET['user'])){
                    $user=$_GET['user'];
                    $comments=$this->model->getByUserName($user);
                    if(empty($comments)){
                        $this->view->response("No se encuentran comentarios de este usuario",404);
                        exit();
                    }
                    $this->view->response($comments);
                }
                
            }
        }else{
            $this->view->response("Parametro GET incorrecto.",400);
            exit();
        }
    }

    function getById($param=null){
        $id=$param[':ID'];
        $comment=$this->model->getById($id);
        if($comment)
            $this->view->response($comment);
        else 
            $this->view->response("El comentario con el id=$id no existe", 404);
    }

    function insert($param=null){
        $userName=$this->helper->checkLoggedIn();
        $data = $this->getData();
        if(empty($data->comment) || empty($data->id_product || empty($data->score))){
            $this->view->response("Complete TODOS los datos(comment,id_product)", 400);
            die();
        }
        if($data->score>5 || $data->score<=0){
            $this->view->response("El valor=($data->score) no es valido, el score tiene que ser un numero entre 1 y 5", 400);
            die();
        }
        $product=$this->productModel->getById($data->id_product);
        
        if($product){
            $id =$this->model->insert($data->comment,$data->score,$data->id_product,$userName);
         
            $comment = $this->model->getById($id);
            $this->view->response($comment, 201);
        }else{
            $this->view->response("El producto con el id=($data->id_product), que quiere comentar no existe",404);
        }
    }
}