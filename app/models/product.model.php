<?php

require_once 'config.php'; 

class ProductModel{

    protected $db;

    public function __construct(){
        $this->db = new PDO('mysql:host='.MYSQL_HOST.';dbname='. MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
    }

    
    public function getProductsCompleto(){
        $query = $this->db->prepare('SELECT * FROM productos INNER JOIN marcas ON marcas.id_marcas = productos.id_marca_fk');
        $query->execute();
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        return $products;
    }

    public function getProductosOrdenados($parametros){

        $sql = 'SELECT * FROM productos';

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

    public function getProductosFiltrados($parametros){

        $sql = 'SELECT * FROM productos';

        if(isset($parametros['color'])){
            $sql.= ' WHERE color = ?';
        }

        $query = $this->db->prepare($sql);
        $query->execute([($parametros['color'])]);

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    public function getCampo($campo){
        $query = $this->db->prepare('SELECT ? FROM productos');
        $query->execute([$campo]);

        $infoCampo = $query->fetchAll(PDO::FETCH_OBJ);

        return $infoCampo;
    }

    public function getProducts(){

        $query = $this->db->prepare('SELECT * FROM productos');
        $query->execute();

        $products = $query->fetchAll(PDO::FETCH_OBJ);

        return $products;
    }

    public function getProduct($id){

        $query = $this->db->prepare('SELECT * FROM productos INNER JOIN marcas ON  productos.id_marca_fk = marcas.id_marcas WHERE productos.id= ?');
        $query->execute([$id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        
        return $product;
    }

    public function searchProducts($id_marca){
        
        $query = $this->db->prepare('SELECT * FROM productos INNER JOIN marcas ON  productos.id_marca_fk = marcas.id_marcas WHERE marcas.id_marcas= ?');
        $query->execute([$id_marca]);
        $products = $query->fetchAll(PDO::FETCH_OBJ);
        
        return $products;
        
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

     public function getCant($paginas, $productosPorPagina){
         //Necesitamos el conteo para saber cuántas páginas vamos a mostrar
         $query = $this->db->prepare("SELECT count(*) AS conteo FROM productos");
         $query->execute();
         $conteo = $query->fetch(PDO::FETCH_OBJ);
         //Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
         $paginas = ceil($conteo / $productosPorPagina);
     }

    public function getPaginado($limit, $offset){//obtenemos los productos usando ya el OFFSET y el LIMIT
        $query = $this->db->prepare("SELECT * FROM productos LIMIT ? OFFSET ?");
        $query->execute([$limit, $offset]);
        $productos = $query->fetchAll(PDO::FETCH_OBJ);

        return $productos;

    }

}