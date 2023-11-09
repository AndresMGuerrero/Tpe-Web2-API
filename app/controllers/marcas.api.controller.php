<?php

require_once './app/controllers/api.controller.php';
require_once './app/models/marcas.model.php';

class MarcasApiController extends ApiController{
    private $modelMarca;
    private $authHelper;

    public function __construct(){
        parent::__construct();
        $this->modelMarca = new MarcasModel();
        $this->authHelper = new AuthApiHelper();  
    }


    public function showMarcas(){ //Hay que agregar un else si no se puede mostrar el listado?
        $marcas = $this->modelMarca->getMarcas();
        $this->view->response($marcas, 200);
    }

    public function borrarMarca($params = []){
        $id = $params[':ID'];
        $marca = $this->modelMarca->getMarca($id);

        if($marca){
            $this->modelMarca->deleteMarca($id);
            $this->view->response('La marca con el id= '.$id. ' ha sido borrada.', 200);
        } else {
            $this->view->response('La marca con el id= '.$id.' no existe.', 404);
        }
    }

    public function updateMarca($params = []){
        $id = $params[':ID'];
        $marca = $this->modelMarca->getMarca($id);

        if($marca){
            $body = $this->getData();

            $nombre = $body->nombre_marca;
            $anio = $body->fecha_creacion;
            $localizacion = $body->loc_fabrica;
            $urlImg = $body->url_imagen;

            $this->modelMarca->updateMarca($id, $nombre, $anio, $localizacion, $urlImg);

            $this->view->response('La marca con id= '.$id.' ha sido modificada.', 200);
        } else {
            $this->view->response('La marca con id= '.$id.' no existe.', 404);
        }
    }
    public function agregarMarca(){

        $user = $this->authHelper->currentUser();
        if(!$user){
            $this->view->response('Sin autorización', 401);
            return;
        }
        $body = $this->getData();

        $nombre = $body->nombre;
        $anio = $body->anio;
        $localizacion = $body->localizacion;
        $urlImg = $body->urlImg;

        $id = $this->modelMarca->insertMarca($nombre, $anio, $localizacion, $urlImg);

        $this->view->response('El marca fue insertado con el id= ' .$id, 201);

    }
}