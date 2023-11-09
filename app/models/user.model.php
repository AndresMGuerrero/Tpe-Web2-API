<?php

require_once 'config.php'; 

class UserModel{

    protected $db;

    function __construct(){
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    public function getUserByName($userName){
        $query = $this->db->prepare('SELECT * FROM administradores WHERE nombre_Usuario= ?');
        $query->execute([$userName]);

        $user = $query->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}