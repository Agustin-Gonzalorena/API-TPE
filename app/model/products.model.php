<?php

class productsModel{
    private $db;

    function __construct(){
        $this->db=$this->connect();
    }

    private function connect() {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_ash;charset=utf8', 'root', '');
        return $db;
    }

    function getAll() {
        $query = $this->db->prepare("SELECT * FROM products");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }
    
    function getAllPaginate($start,$cantPages){
        $query = $this->db->prepare("SELECT * FROM products LIMIT $start,$cantPages");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function quantityProducts(){
        $query = $this->db->prepare("SELECT * FROM products");
        $query->execute();
        $quantity=$query->rowCount();
        return $quantity;
    }
    
    function orderByColumn($column,$order){
        $query = $this->db->prepare("SELECT * FROM `products` ORDER BY `products`.`$column` $order");
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    function get($id){
        $query=$this->db->prepare("SELECT* FROM products WHERE id=?");
        $query->execute([$id]);
        $product=$query->fetch(PDO::FETCH_OBJ);
        return $product;
    }

    function delete($id){
        $query = $this->db->prepare('DELETE FROM products WHERE id = ?');
        $query->execute([$id]);
    }

    function insert($name,$description,$image,$price,$stock,$id_types) {
        $query = $this->db->prepare("INSERT INTO products (`name`, `description`,`image`,`price`, `stock`,`id_types`) VALUES (?, ?, ?, ?, ?,?)");
        $query->execute([$name,$description,$image,$price,$stock,$id_types]);

        return $this->db->lastInsertId();
    }

    function update($name,$description,$pathImg,$price,$stock,$type,$id){
        $query=$this->db->prepare("UPDATE products SET `name`=?,`description`=?,`image`=?,`price`=?, `stock`=?, `id_types`=? WHERE id=? ");
        $query->execute([$name,$description,$pathImg,$price,$stock,$type,$id]);
    }
}