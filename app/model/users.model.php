<?php

class usersModel {
    private $db;

    function __construct() {
        $this->db=$this->connect();
    }

    private function connect() {
        $db = new PDO('mysql:host=localhost;'.'dbname=db_ash;charset=utf8', 'root', '');
        return $db;
    }

    function getAll(){
        $query = $this->db->prepare("SELECT * FROM users");
        $query->execute();
        $users = $query->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }

    function getUserByUserName($userName) {
        $query = $this->db->prepare("SELECT * FROM users WHERE userName = ?");
        $query->execute([$userName]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    function getUserById($id){
        $query = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}