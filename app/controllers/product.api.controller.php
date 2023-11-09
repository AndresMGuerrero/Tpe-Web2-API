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
        if(empty($params)){
            $products = $this->modelProd-> getProductsCompleto();
            $this ->view->response($products, 200);
        } else {
            $products = $this->modelProd-> getProduct($params[':ID']);
            if(!empty($products)){
                return $this->view->response($products, 200);
            } else {
                return $this->view->response('El producto con el id= '.$params[':ID'].' no existe.', 404);
            }
        }
    }

    public function showProductosOrdenados($params = []){
        $parametros = [];

        //buscar consulta sql para traer los nombres de columna o armar un arreglo con los nombres de las columnas que se pueden elegir
        
        if(isset($_GET['sort'])){
            $parametros['sort']= $_GET['sort'];
        }

        if(isset($_GET['order'])){
            $parametros['order']= $_GET['order'];
        }

        
        $products = $this->modelProd-> getProductosOrdenados($parametros);
        $this ->view->response($products, 200);
    }

    public function showProductosPorFiltro($params = []){
        $parametros = [];

        if(isset($_GET['color'])){
            $parametros['color']= $_GET['color'];
        }
                   
        $products = $this->modelProd-> getProductosFiltrados($parametros);
        if($products!=[]){
            $this ->view->response($products, 200);
        } else {
            $this ->view->response('No existe el color', 400);
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

    public function PaginadoProduct($param = []){
        $pagina_actual = 1;

        if(isset($_GET['pagina'])){
            $pagina_actual = $_GET['pagina'];
        } else {
            $pagina_actual = 1;
        }

        
    }
}