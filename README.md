# API REST para manejo de productos y marcas del sitio web ShoeSpot
Esta API REST le permitirá manejar el ABM de los productos y marcas del sitio web.

### Importar la base de datos
importar desde PHPMyAdmin : database/db_shoespot.sql


## Descripcion de Enpoints de la API

### ***Endpoint: productos***

### localhost/web2/TPE-Web2-API/api/productos (verbo GET)

Línea en router: ***$router->addRoute('productos', 'GET', 'ProductApiController', 'showProducts');***

Esta url sin ningún parámetro, utilizando el verbo GET, va a listar los productos del sitio web según vienen de la base de datos.

***Uso de parámetros (siempre escribir los valores en minúsculas)***

***Parámetros sort y order:***

Incorporando estos parámetros a la url podrá hacer uso de la función de ordenamiento, agregando como valor del parametro _sort_ el campo por el cual quiere ordenar los productos y como valor del parametro _order_: ASC (para ordenarlos de manera ascendente) o DESC (para ordenarlos de manera descendiente).

Se puede ordenar los productos según los siguientes campos:

- id
- nombre_producto
- color
- talle
- tipo
- precio
- id_marcas
- nombre_marca

Si quisiera ordenar los productos por "tipo" de manera ascendente, la url quedaría de la siguiente manera: 
***localhost/web2/TPE-Web2-API/api/productos?sort=tipo&order=ASC***

***Parámetro color:***

Incorporando este parámetro a la url podrá hacer uso de la función de filtración por color, agregando como valor del parametro _color_ el color por el cual quiere ordenar los productos.

Si quisiera filtrar los productos que sean de color rojo, la url quedaría de la siguiente manera: 
***localhost/web2/TPE-Web2-API/api/productos?color=rojo***

***Parámetro marca:***

Incorporando este parámetro a la url podrá hacer uso de la función de filtración por marca, agregando como valor del parametro _marca_ la marca por la cual quiere ordenar los productos.

Si quisiera filtrar los productos que sean de la marca nike, la url quedaría de la siguiente manera: 
***localhost/web2/TPE-Web2-API/api/productos?marca=nike***

***Parámetro pagina:***

Incorporando este parámetro a la url podrá hacer uso de la función de paginación, agregando como valor del parametro _pagina_ el número de página que quiere visitar. La cantidad de productos por página está seteado en 5.

Si quisiera visitar la página número 2 y ver sus respectivos productos, la url quedaría de la siguiente manera: 
***localhost/web2/TPE-Web2-API/api/productos?pagina=2***

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



