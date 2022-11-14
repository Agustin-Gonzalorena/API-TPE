<?php
require_once './app/model/products.model.php';
require_once './app/view/api.view.php';
require_once './app/helpers/auth.helper.php';

class productsController{
    private $model;
    private $view;
    private $data;
    private $authHelper;

    public function __construct() {
        $this->model = new productsModel();
        $this->view = new apiView();
        $this->authHelper=new authHelper();
        $this->data = file_get_contents("php://input");// lee el body del request
    }

    private function getData() {
        return json_decode($this->data);
    }

    function getAll($params=null){
        if(count($_GET)==1){
            $products=$this->model->getAll();
            $this->view->response($products);

        }elseif(count($_GET)==2){
            if(empty($_GET['filter'])){
                $this->view->response("Parametro GET incorrecto", 400);
            }else{
                $column=$_GET['filter'];
                $products=$this->filterByProduct($column);
                $this->view->response($products);  
            }
        }elseif(count($_GET)==3){
            if(isset($_GET['column']) && isset($_GET['order'])){
                if(empty($_GET['order'])||empty($_GET['column'])){
                    $this->view->response("Al parametro GET le falta la variable order o column", 400);
                }else{
                    $column=$_GET['column'];
                    $column=$this->checkParamColumn($column);
                    $order=$_GET['order'];
                    $order=$this->checkParamOrder($order);
                    $products=$this->model->orderByColumn($column,$order);
                    $this->view->response($products);
                }
            }elseif(isset($_GET['page']) && isset($_GET['size'])){
                $page=$_GET['page'];
                $size=$_GET['size'];
                $this->checkPaginate($page,$size);
                $products=$this->model->getAllPaginate($page,$size);
                $this->view->response($products);    

            }else{
                $this->view->response("Parametro GET desconocido", 400);
            }
        }else{
            $this->view->response("Parametro GET desconocido", 400);
        }
    }

    private function filterByProduct($column){
        $products=$this->model->getAll();
        $array=array();

        if($column=='remeras'){
            foreach($products as $product)
                if($product->id_types==1 || $product->id_types==2 || $product->id_types==3)
                    array_push($array,$product);

        }elseif($column=='buzos'){
            foreach($products as $product)
                if($product->id_types==4 || $product->id_types==5 || $product->id_types==6)
                    array_push($array,$product);

        }elseif($column=='camperas'){
            foreach($products as $product)
                if($product->id_types==7 || $product->id_types==8)
                    array_push($array,$product);

        }else{
            $this->view->response("El tipo de producto=($column) no existe", 404);
            exit();
        }
        return $array; 
    }
    private function checkPaginate($page,$size){
        if(!is_integer($page) && $page<=0)
            $this->view->response("El parametro (page) debe ser numero positivo", 400);

        if(!is_integer($size) && $size<=0)
            $this->view->response("El parametro (size) debe ser numero positivo", 400);

        $quantity=$this->model->quantityProducts();
        if($page>=$quantity){
            $this->view->response("La pagina ($page) no existe", 404);
            exit();
        }
    }
    private function checkParamColumn($column){
            if($column!='name' && $column!='stock' && $column!='price'){
                $this->view->response("El parametro column=($column) no existe",404);
                exit(); 
            }
            return $column;
    }
    private function checkParamOrder($order){
        if($order=='a'){
            $order='ASC';
            return $order;
        }elseif($order=='d'){
            $order='DESC';
            return $order;
        }else{
            $error=$order;
            $this->view->response("El parametro de orden=($error) es incorrecto",400);
            exit();
        }
    }

    function getById($params=null){
        $id = $params[':ID'];
        $product = $this->model->getById($id);
        if($product)
            $this->view->response($product);
        else 
            $this->view->response("El producto con el id=$id no existe", 404);
    }
    
    function delete($params=null){
        $this->authHelper->checkAdmin();
        $id=$params[':ID'];        
        $product = $this->model->getById($id);
        if($product){
            $this->model->delete($id);
            $this->view->response($product);
        }else{
            $this->view->response("El producto con el id=$id no existe", 404);
        }
    }

    function insert($params=null){
        $this->authHelper->checkAdmin();
        $product = $this->getData();
        if (empty($product->name) || empty($product->description) || empty($product->image) || empty($product->price) || empty($product->stock) || empty($product->id_types)) {
            $this->view->response("Complete TODOS los datos(name,description,image,price,stock,id_types)", 400);
        } else {
            $id = $this->model->insert($product->name, $product->description, $product->image,$product->price,$product->stock,$product->id_types);
            $product = $this->model->getById($id);
            $this->view->response($product, 201);
        }
    }

    function update($params=null){
        $this->authHelper->checkAdmin();
        $idProduct=$params[':ID'];
        $products=$this->model->getAll();
        $valor=array_search($idProduct, array_column($products, 'id'));
        if(!is_integer($valor)){
            $this->view->response("El producto con id=($idProduct) no existe",404);
            die();
        }
        $product = $this->model->getById($idProduct);
        $newProduct = $this->getData();
        if(empty($newProduct)){
            $this->view->response("No se recibio ningun campo a modificar",400);
            die();
        }
        if(isset($newProduct->name)){
            $product->name=$newProduct->name;
        }
        if(isset($newProduct->description)){
            $product->description=$newProduct->description;
        }
        if(isset($newProduct->image)){
            $product->image=$newProduct->image;
        }
        if(isset($newProduct->price)){
            $product->price=$newProduct->price;
        }
        if(isset($newProduct->stock)){
            $product->stock=$newProduct->stock;
        }
        if(isset($newProduct->id_types)){
            $product->id_types=$newProduct->id_types;
        }
        $this->model->update($product->name,$product->description,$product->image,$product->price,$product->stock,$product->id_types,$idProduct);
        $product = $this->model->getById($idProduct);
        $this->view->response($product, 201);
    }


    function errorEndpoint(){
        $this->view->response("Endpoint incorrecto",404);
    }
}