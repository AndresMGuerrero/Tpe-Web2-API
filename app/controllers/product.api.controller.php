<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/product.model.php';
require_once './app/helpers/auth.api.helper.php';

class ProductApiController extends ApiController{
    private $modelProd;
    private $authHelper;
    

    public function __construct(){
        parent::__construct();
        $this->modelProd = new ProductModel();
        $this->authHelper = new AuthApiHelper();        
    }

    public function showProducts($params = []){
        
        $parametros = [];

        $nombresCol = ["id", "nombre_producto", "color", "talle", "tipo", "precio", "url_imagenP", "id_marca_fk"];//No pudimos resolverlo con una consulta sql. Por eso armamos un arreglo.
        
        if(isset($_GET['sort'])&& isset($_GET['order'])){// Opción de ordenamiento por un campo a elección del usuario
            for($i = 0; $i<count($nombresCol); $i++){// Se ve si existe la columna por la cual se quiere ordenar
                                    
                if($nombresCol[$i] == $_GET['sort']){
                    $parametros['sort']= $_GET['sort'];
                    $parametros['order']= $_GET['order'];
                }
            }

        } elseif (isset($_GET['color'])) { //Opción de filtrado por color
            
            $parametros['color']= $_GET['color'];        
                
            $products = $this->modelProd-> getProductosFiltradosPorColor($parametros);
            if($products!=[]){
                $this ->view->response($products, 200);
            } else {
                $this ->view->response('No existe un producto de color '.$_GET['color'].'.', 400);
            }
            return;

        } elseif (isset($_GET['marca'])){ //Opción de filtrado por marca
            $parametros['marca']= $_GET['marca'];        
                
            $products = $this->modelProd-> getProductosFiltradosPorMarca($parametros);
            if($products!=[]){
                $this ->view->response($products, 200);
            } else {
                $this ->view->response('No existen productos con la marca ( '.$_GET['marca'].' ).', 400);// modif
            }
            return;
            
        } elseif (isset($_GET['pagina'])){ //Opción de paginado
            $parametros['pagina']= $_GET['pagina'];        
                
            $products = $this->modelProd-> getProductosPorPagina($parametros);
            if($products!=[]){
                $this ->view->response($products, 200);
            } else {
                $this ->view->response('No existe la página '.$_GET['pagina'].'.', 404);
            }
            return;
        }

        if(empty($parametros)&&isset($_GET['sort'])&& isset($_GET['order'])){// Respuesta a la inexistencia de la columna elegida
            $this->view->response('La columna por la cual se quiere ordenar ('.$_GET['sort'].') no existe', 400);
            return;
        }
        

        if(!empty($parametros)){ //Si están los parametros de ordenamiento se procede a ordenar.
            $products = $this->modelProd-> getProductosOrdenados($parametros);
            $this ->view->response($products, 200);
        } else { // si no, se muestra la lista de productos según viene de la base de datos.            
            $products = $this->modelProd-> getProductsCompleto();
            $this ->view->response($products, 200);
        }
        
    }

    public function showProduct($params = []){
        $id = (int)$params[':ID'];
        
        $product = $this->modelProd-> getProduct($id);
        
        if(!empty($product)){
            return $this->view->response($product, 200);
        } else {
            return $this->view->response('El producto con el id= '.$id.' no existe.', 404);
        }
    }

    
    public function agregarProd($params = []){
        
        //token
        $user = $this->authHelper->currentUser();
        if(!$user){
            $this->view->response('Sin autorización', 401);
            return;
        }

        $body = $this->getData();

        $nombre = $body->nombre_producto;
        $color = $body->color;
        $talle = $body->talle;
        $tipo = $body->tipo;
        $precio = $body->precio;
        $urlImgProd = $body->url_imagenP;
        $marca = $body->id_marca_fk;

        $id = $this->modelProd->insertProduct($nombre, $color, $talle, $tipo, $precio, $urlImgProd, $marca);

        $this->view->response('El producto fue insertado con el id= ' .$id, 201);
    }

    public function borrarProd($params = []){
        $id = $params[':ID'];
        $product = $this->modelProd->getProduct($id);

        if($product){
            $this->modelProd->deleteProduct($id);
            $this->view->response('El producto con id= ' .$id.' ha sido borrado.', 200);
        } else {
            $this->view->response('El producto con id= ' .$id.' no existe.', 404);
        }
    }

    public function updateProd($params = []){
        
        //token
        $user = $this->authHelper->currentUser();
        if(!$user){
            $this->view->response('Sin autorización', 401);
            return;
        }

        $id = $params[':ID'];
        $product = $this->modelProd->getProduct($id);

        if($product){
            $body = $this->getData();

            $nombre = $body->nombre_producto;
            $color = $body->color;
            $talle = $body->talle;
            $tipo = $body->tipo;
            $precio = $body->precio;
            $urlImgProd = $body->url_imagenP;
            $marca = $body->id_marca_fk;

            $this->modelProd->updateProduct($id, $nombre, $color, $talle, $tipo, $precio, $urlImgProd, $marca);

            $this->view->response('El producto con id= ' .$id.' ha sido modificado.', 200);
        } else {
            $this->view->response('El producto con id= ' .$id.' no existe.', 404);
        }
    }

    
}