<?php

class commentsModel{
    private $db;

    function __construct(){
        $this->db=$this->connect();
    }

    private function connect() {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_ash;charset=utf8', 'root', '');
        return $db;
    }

    function getAll(){
        $query=$this->db->prepare("SELECT* FROM comments");;
        $query->execute();
        $comments=$query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    function getByProduct($id){
        $query=$this->db->prepare("SELECT* FROM comments WHERE id_product=?");;
        $query->execute([$id]);
        $comments=$query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    function getByUserName($user){
        $query=$this->db->prepare("SELECT* FROM comments WHERE author=?");;
        $query->execute([$user]);
        $comments=$query->fetchAll(PDO::FETCH_OBJ);
        return $comments;
    }

    function getById($id){
        $query=$this->db->prepare("SELECT* FROM comments WHERE id=?");
        $query->execute([$id]);
        $comment=$query->fetch(PDO::FETCH_OBJ);
        return $comment;
    }
    
    function insert($comment,$score,$idProduct,$user){
        $query = $this->db->prepare("INSERT INTO comments (`comment`,`score`,`id_product`,`author`) VALUES (?, ?, ?, ?)");
        $query->execute([$comment,$score,$idProduct,$user]);

        return $this->db->lastInsertId();
    }
}