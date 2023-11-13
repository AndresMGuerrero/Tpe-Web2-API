<?php

require_once 'libs/router.php';
require_once './app/controllers/product.api.controller.php';
require_once './app/controllers/marcas.api.controller.php';
require_once './app/controllers/user.api.controller.php';

$router = new Router();


//Definir rutas



$router->addRoute('productos', 'GET', 'ProductApiController', 'showProducts');
$router->addRoute('productos/:ID', 'GET', 'ProductApiController', 'showProducts');
$router->addRoute('productos', 'POST', 'ProductApiController', 'agregarProd');
$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController', 'borrarProd');
$router->addRoute('productos/:ID', 'PUT', 'ProductApiController', 'updateProd');
$router->addRoute('marcas', 'GET', 'MarcasApiController', 'showMarcas');
$router->addRoute('marcas/:ID', 'GET', 'MarcasApiController', 'showMarcas');
$router->addRoute('marcas', 'POST', 'MarcasApiController', 'agregarMarca');
$router->addRoute('user/token', 'GET', 'UserApiController', 'getToken');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);