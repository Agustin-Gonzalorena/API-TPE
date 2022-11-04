<?php

class categoriesModel{
    private $db;

    function __construct(){
        $this->db=$this->connect();
    }

    private function connect() {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_ash;charset=utf8', 'root', '');
        return $db;
    }

    function getAll() {
        $query = $this->db->prepare("SELECT * FROM categories");
        $query->execute();
        $categories = $query->fetchAll(PDO::FETCH_OBJ);
        return $categories;
    }

    function get($id){
        $query=$this->db->prepare("SELECT* FROM categories WHERE id=?");
        $query->execute([$id]);
        $categories=$query->fetch(PDO::FETCH_OBJ);
        return $categories;
    }
}