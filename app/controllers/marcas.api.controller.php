<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/marcas.model.php';
require_once './app/helpers/auth.api.helper.php';

class MarcasApiController extends ApiController{
    private $modelMarca;
    private $authHelper;

    public function __construct(){
        parent::__construct();
        $this->modelMarca = new MarcasModel();
        $this->authHelper = new AuthApiHelper();  
    }


    public function showMarcas($params = []){
        if(empty($params)){
            $parametros = [];

            $nombresCol = ["id_marcas", "nombre_marca", "fecha_creacion", "loc_fabrica", "url_imagen"]; //No pudimos resolver con una consulta sql por eso creamos el arreglo.
            
            if(isset($_GET['sort'])&& isset($_GET['order'])){// Opción de ordenamiento por un campo a elección del usuario
                for($i = 0; $i<count($nombresCol); $i++){// Se ve si existe la columna por la cual se quiere ordenar
                                        
                    if($nombresCol[$i] == $_GET['sort']){
                        $parametros['sort']= $_GET['sort'];
                        $parametros['order']= $_GET['order'];
                    }
                }
            } elseif (isset($_GET['localizacion'])) { //Opción de filtrado por localización
                
                $parametros['localizacion']= $_GET['localizacion'];        
                   
                $marcas = $this->modelMarca-> getMarcasFiltradas($parametros);
                if($marcas!=[]){
                    $this ->view->response($marcas, 200);
                } else {
                    $this ->view->response('No existe la localización= '.$_GET['localizacion'].'.', 400);
                }
                return;
            } elseif (isset($_GET['pagina'])){ //Opción de paginado
                $parametros['pagina']= $_GET['pagina'];        
                   
                $products = $this->modelMarca-> getMarcasPorPagina($parametros);
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
                $marcas = $this->modelMarca-> getMarcasOrdenadas($parametros);
                $this ->view->response($marcas, 200);
            } else { // si no, se muestra la lista de productos según viene de la base de datos.            
                $marcas = $this->modelMarca-> getMarcas();
                $this ->view->response($marcas, 200);
            }         

        } else { //Si $params no está vacio quiere decir que ese dato es un ID
            $marca = $this->modelMarca-> getMarca($params[':ID']);
            if(!empty($marca)){
                return $this->view->response($marca, 200);
            } else {
                return $this->view->response('La marca con el id= '.$params[':ID'].' no existe.', 404);
            }
        }
    }

    
    public function agregarMarca(){

        $user = $this->authHelper->currentUser();
        if(!$user){
            $this->view->response('Sin autorización', 401);
            return;
        }
        
        $body = $this->getData();

        $nombre = $body->nombre_marca;
        $anio = $body->fecha_creacion;
        $localizacion = $body->loc_fabrica;
        $urlImg = $body->url_imagen;

        $id = $this->modelMarca->insertMarca($nombre, $anio, $localizacion, $urlImg);

        $this->view->response('El marca fue insertado con el id= ' .$id, 201);

    }
}