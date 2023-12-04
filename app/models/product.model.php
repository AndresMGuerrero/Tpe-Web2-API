<?php

require_once 'config.php'; 

class ProductModel{

    protected $db;

    public function __construct(){
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    
    public function getProductsCompleto(){
        $query = $this->db->prepare('SELECT productos.*, marcas.id_marcas, marcas.nombre_marca FROM productos INNER JOIN marcas ON marcas.id_marcas = productos.id_marca_fk ORDER BY id'); //modif
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function getProductosOrdenados($parametros){

        $sql = 'SELECT productos.*, marcas.id_marcas, marcas.nombre_marca FROM productos INNER JOIN marcas ON marcas.id_marcas = productos.id_marca_fk';

        if(isset($parametros['sort'])){
            $sql.= ' ORDER BY '.$parametros['sort'];

            if(isset($parametros['order'])){
                $sql.= ' '.$parametros['order'];
            }
        }

        $query = $this->db->prepare($sql);
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    public function getProductosFiltradosPorMarca($parametros){

        $sql = 'SELECT productos.*, marcas.id_marcas, marcas.nombre_marca FROM productos INNER JOIN marcas ON marcas.id_marcas = productos.id_marca_fk';

        if(isset($parametros['marca'])){
            $sql.= ' WHERE marcas.nombre_marca = ?';
        }

        $query = $this->db->prepare($sql);
        $query->execute([($parametros['marca'])]);

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    public function getProductosFiltradosPorColor($parametros){

        $sql = 'SELECT productos.*, marcas.id_marcas, marcas.nombre_marca FROM productos INNER JOIN marcas ON marcas.id_marcas = productos.id_marca_fk';

        if(isset($parametros['color'])){
            $sql.= ' WHERE color = ?';
        }

        $query = $this->db->prepare($sql);
        $query->execute([($parametros['color'])]);

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    public function getProductosPorPagina($parametros){
        

        $pagina = (int)$parametros['pagina'];
        $limit = cantItemsPorPag;
        $offset = ($pagina -1)*$limit;

        $query = $this->db->prepare("SELECT productos.*, marcas.id_marcas, marcas.nombre_marca FROM productos INNER JOIN marcas ON marcas.id_marcas = productos.id_marca_fk LIMIT $offset, $limit"); //Intentamos poner los signos de pregunta y las variables en el execute pero no funcionaba.
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
        
    }

    
    public function getProduct($id){

        $query = $this->db->prepare('SELECT productos.id, productos.nombre_producto, productos.color, productos.talle, productos.tipo, productos.precio, productos.url_imagenP, productos.id_marca_fk, marcas.id_marcas, marcas.nombre_marca FROM productos INNER JOIN marcas ON marcas.id_marcas = productos.id_marca_fk WHERE productos.id= ?');
        $query->execute([$id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        
        return $product;
    }

    
    public function insertProduct($nombre, $color, $talle, $tipo, $precio, $urlImgProd, $marca){
        $query = $this->db->prepare('INSERT INTO productos (nombre_producto, color, talle, tipo, precio, url_imagenP, id_marca_fk) VALUES (?,?,?,?,?,?,?)');
        $query->execute([$nombre, $color, $talle, $tipo, $precio, $urlImgProd, $marca]);

        return $this->db->lastInsertId();
    }

    public function deleteProduct($id){
        $query = $this->db->prepare('DELETE FROM productos WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateProduct($id, $nombre, $color, $talle, $tipo, $precio, $urlImgProd, $marca){
        
        $query = $this->db->prepare('UPDATE productos SET nombre_producto = ? , color = ? , talle = ? , tipo = ? , precio = ? , url_imagenP = ?, id_marca_fk = ? WHERE id = ?');
        $query->execute([$nombre, $color, $talle, $tipo, $precio, $urlImgProd, $marca, $id]);
        
    }

    
}