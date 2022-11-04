<?php
require_once './app/model/products.model.php';
require_once './app/view/products.view.php';

class productsController{
    private $model;
    private $view;
    private $data;

    public function __construct() {
        $this->model = new productsModel();
        $this->view = new productsView();
        
        // lee el body del request
        $this->data = file_get_contents("php://input");
    }

    private function getData() {
        return json_decode($this->data);
    }

    function get($params=null){
        if($params==null){
            $products=$this->model->getAll();
            $this->view->response($products);
        }/* elseif($params[':ID']=='name'){
            $products=$this->model->filter($params[':ID']);
            $this->view->response($products);
        }elseif($params[':ID']=='price'){
            $products=$this->model->filter($params[':ID']);
            $this->view->response($products);
        } */
        else{
            $id = $params[':ID'];
            $product = $this->model->get($id);

            if ($product)
                $this->view->response($product);
            else 
                $this->view->response("El producto con el id=$id no existe", 404);
        }
    }
    function filter($params=null){
        if($params[':ORD']=='a')
                $order='ASC';
        elseif($params[':ORD']=='d')
                $order='DESC';
        else{
            $error=$params[':ORD'];
            $this->view->response("El parametro=($error) no existe",404);
            exit();
        }
        switch($params[':COLUMNS']){
            case 'stock':
                $products=$this->model->filter($params[':COLUMNS'],$order);
                $this->view->response($products);
                break;
            case 'name':
                $products=$this->model->filter($params[':COLUMNS'],$order);
                $this->view->response($products);
                break;
            case 'price':
                $products=$this->model->filter($params[':COLUMNS'],$order);
                $this->view->response($products);
                break;
            default:
                $error=$params[':COLUMNS'];
                $this->view->response("La columna=($error) no exite",404);
        }
    }
    function delete($params=null){
        $id=$params[':ID'];
        $product = $this->model->get($id);

        if($product){
            $this->model->delete($id);
            $this->view->response($product);
        }else{
            $this->view->response("El producto con el id=$id no existe", 404);
        }
    }

    function insert($params=null){
        $product = $this->getData();

        if (empty($product->name) || empty($product->description) || empty($product->image) || empty($product->price) || empty($product->stock) || empty($product->id_types)) {
            $this->view->response("Complete los datos", 400);
        } else {
            $id = $this->model->insert($product->name, $product->description, $product->image,$product->price,$product->stock,$product->id_types);
            $product = $this->model->get($id);
            $this->view->response($product, 201);
        }
    }
    function update($params=null){
        $idProduct=$params[':ID'];
        $product = $this->model->get($idProduct);
        $newProduct = $this->getData();
        $array=array();
        if(empty($newProduct->name))
            array_push($array,$product->name);
        else
            array_push($array,$newProduct->name);

        if(empty($newProduct->description))
            array_push($array,$product->description);
        else
            array_push($array,$newProduct->description);
        
        if(empty($newProduct->image))
            array_push($array,$product->image);
        else
            array_push($array,$newProduct->image);

        if(empty($newProduct->price))
            array_push($array,$product->price);
        else
            array_push($array,$newProduct->price);
        
        if(empty($newProduct->stock))
            array_push($array,$product->stock);
        else
            array_push($array,$newProduct->stock);
        
        if(empty($newProduct->id_types))
            array_push($array,$product->id_types);
        else
            array_push($array,$newProduct->id_types);
        
        $this->model->update($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$idProduct);
        $product = $this->model->get($idProduct);
        $this->view->response($product, 201);
    }
}