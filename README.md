# API REST para manejo de productos y marcas
Esta API REST le permitirá manejar el ABM de los productos y marcas de el sitio web.

## Importar la base de datos
importar desde PHPMyAdmin : database/db_shoespot.sql

## Endpoints de la API

-localhost/web2/TPE-Web2-API/api/productos

## Descripcion de Enpoints 
-$router->addRoute('productos', 'GET', 'ProductApiController', 'showProducts');
-Esta linia lo que genera es un listados es este caso de todos los productos pasansole el producto a la url.
-Ejemplo: -localhost/web2/TPE-Web2-API/api/productos

-$router->addRoute('productos/:ID', 'GET', 'ProductApiController', 'showProducts');
-La funcion que tiene es traer un elemento por id, en este caso trae un producto por id.
-Ejemplo: localhost/web2/TPE-Web2-API/api/productos/22

-$router->addRoute('productos', 'POST', 'ProductApiController', 'agregarProd');
-Este endpoint tiene como funcion agregar un producto nuevo.
-Ejemplo: -localhost/web2/TPE-Web2-API/api/productos Mas el verbo POST.

-$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController', 'borrarProd');
-Tiene como funcion eliminar un elemento, en este caso eliminar un producto por id.
-Ejemplo: localhost/web2/TPE-Web2-API/api/productos/22 Mas el verbo DELETE.

-$router->addRoute('productos/:ID', 'PUT', 'ProductApiController', 'updateProd');
-Modifica un producto por un id correspondiente.
-Ejemplo: localhost/web2/TPE-Web2-API/api/productos/30 Mas el verbo PUT 

-$router->addRoute('marcas', 'GET', 'MarcasApiController', 'showMarcas');
-Este endpoint muestra todas la marcas, colocando el verbo GET.
-Ejemplo: localhost/web2/TPE-Web2-API/api/marcas

-$router->addRoute('marcas/:ID', 'GET', 'MarcasApiController', 'showMarcas');
-Trae una marca por id, para mostrarla.
-Ejemplo: localhost/web2/TPE-Web2-API/api/marcas/25

-$router->addRoute('marcas', 'POST', 'MarcasApiController', 'agregarMarca');
-Agrega una marca nueva, para luego mostrarla con las demas marcas.
-Ejemplo: localhost/web2/TPE-Web2-API/api/marcas/25 Mas el verbo POST

-$router->addRoute('marcas/:ID', 'DELETE', 'MarcasApiController', 'borrarMarca');
-Elimina una marca por id.
-Ejemplo: localhost/web2/TPE-Web2-API/api/marcas/27 Mas el verbo DELETE

-$router->addRoute('marcas/:ID', 'PUT', 'MarcasApiController', 'updateMarca');
-Modifica una marca por un id correspondiente.
-Ejemplo: localhost/web2/TPE-Web2-API/api/marcas/28 Mas el verbo PUT

-$router->addRoute('user/token', 'GET', 'UserApiController', 'getToken');
-Verifica que usuario tenga acceso para poder utilizar funciones como agregar y modficar, esto se hace generando el token y luego pegandolo para ser actorizado.
-Ejemplo: localhost/web2/TPE-Web2-API/api/user/token Luego los verbos correspondientes.

