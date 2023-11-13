# API REST para manejo de productos y marcas del sitio web ShoeSpot
Esta API REST le permitirá manejar el ABM de los productos y marcas del sitio web.

### Importar la base de datos
importar desde PHPMyAdmin : database/db_shoespot.sql


## Descripcion de Enpoints de la API

### ***Endpoint: productos***

### localhost/web2/TPE-Web2-API/api/productos (verbo GET)

Línea en router: ***$router->addRoute('productos', 'GET', 'ProductApiController', 'showProducts');***

Esta url sin ningún parámetro, utilizando el verbo GET, va a listar los productos del sitio web según vienen de la base de datos.

### localhost/web2/TPE-Web2-API/api/productos/:ID (verbo GET)

Línea en router: ***$router->addRoute('productos/:ID', 'GET', 'ProductApiController', 'showProducts');***

En este caso, si se le agrega a la url anterior, una barra y un ID se podrá traer el producto que posea dicho ID.

### localhost/web2/TPE-Web2-API/api/productos/:ID (verbo DELETE)

Línea en router: ***$router->addRoute('productos/:ID', 'DELETE', 'ProductApiController', 'borrarProd');***

Utilizando el verbo DELETE y especificando el ID del producto (/ID), se podrá eliminar el producto que posea dicho ID.

### ***Endpoint: marcas***

### localhost/web2/TPE-Web2-API/api/marcas (verbo GET)

Línea en router: ***$router->addRoute('marcas', 'GET', 'MarcasApiController', 'showMarcas');***

Esta url sin ningún parámetro, utilizando el verbo GET, va a listar las marcas cargadas en el sitio web según vienen de la base de datos.

### localhost/web2/TPE-Web2-API/api/productos/:ID (verbo GET)

Línea en router: ***$router->addRoute('marcas/:ID', 'GET', 'MarcasApiController', 'showMarcas');***

En este caso, si se le agrega a la url anterior, una barra y un ID se podrá traer la marca que posea dicho ID.

### localhost/web2/TPE-Web2-API/api/productos/:ID (verbo DELETE)

Línea en router: ***addRoute('marcas/:ID', 'DELETE', 'MarcasApiController', 'borrarMarca');***

Utilizando el verbo DELETE y especificando el ID de la marca (/ID), se podrá eliminar la marca que posea dicho ID.


### token

-$router->addRoute('user/token', 'GET', 'UserApiController', 'getToken');
-Verifica que usuario tenga acceso para poder utilizar funciones como agregar y modficar, esto se hace generando el token y luego pegandolo para ser actorizado.
-Ejemplo: localhost/web2/TPE-Web2-API/api/user/token Luego los verbos correspondientes.

### ***Endpoint: productos***

### localhost/web2/TPE-Web2-API/api/productos (verbo POST)

Línea en router: $router->addRoute('productos', 'POST', 'ProductApiController', 'agregarProd');

En este caso, colocando en el body de Postman lo siguiente:

```
git status
git add
git commit
```


-$router->addRoute('productos/:ID', 'PUT', 'ProductApiController', 'updateProd');
-Modifica un producto por un id correspondiente.
-Ejemplo: localhost/web2/TPE-Web2-API/api/productos/30 Mas el verbo PUT 

```
git status
git add
git commit
```

### ***Endpoint: marcas***

-$router->addRoute('marcas', 'POST', 'MarcasApiController', 'agregarMarca');
-Agrega una marca nueva, para luego mostrarla con las demas marcas.
-Ejemplo: localhost/web2/TPE-Web2-API/api/marcas/25 Mas el verbo POST

```
git status
git add
git commit
```


-$router->addRoute('marcas/:ID', 'PUT', 'MarcasApiController', 'updateMarca');
-Modifica una marca por un id correspondiente.
-Ejemplo: localhost/web2/TPE-Web2-API/api/marcas/28 Mas el verbo PUT

```
git status
git add
git commit
```



