<?php

require_once 'config.php'; 

class MarcasModel{

    protected $db;

    function __construct(){
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    public function getMarcas(){

        $query = $this->db->prepare('SELECT * FROM marcas');
        $query->execute();

        $marcas = $query->fetchAll(PDO::FETCH_OBJ);

        return $marcas;
    }

    public function insertMarca($nombre, $anio, $localizacion, $urlImg){
        $query = $this->db->prepare('INSERT INTO marcas (nombre_marca, fecha_creacion, loc_fabrica, url_imagen) VALUES (?,?,?,?)');
        $query->execute([$nombre, $anio, $localizacion, $urlImg]);

        return $this->db->lastInsertId();
    }

    public function deleteMarca($id){
        $query = $this->db->prepare('DELETE FROM marcas WHERE id_marcas = ?');
        $query->execute([$id]);
    }

    public function getMarca($id){

        $query = $this->db->prepare('SELECT * FROM marcas WHERE id_marcas = ?');
        $query->execute([$id]);

        $marca = $query->fetch(PDO::FETCH_OBJ);

        return $marca;
    }

    public function updateMarca($id, $nombre, $anio, $localizacion, $urlImg){
        $query = $this->db->prepare('UPDATE marcas SET fecha_creacion = ? , loc_fabrica = ?, url_imagen = ? WHERE id_marcas = ?');
        $query->execute([$anio, $localizacion, $urlImg, $id]);
    }
}