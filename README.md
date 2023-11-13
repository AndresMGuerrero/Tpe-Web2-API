# API REST para manejo de productos y marcas del sitio web ShoeSpot
Esta API REST le permitirá manejar el ABM de los productos y marcas del sitio web.

### Importar la base de datos
importar desde PHPMyAdmin : database/db_shoespot.sql

## Acciones que se pueden realizar con esta API

**Productos:** Listar (GET, con o sin parámetros), eliminar (DELETE), agregar (POST), modificar (PUT).
**Marcas:** Listar (GET, con o sin parámetros) y agregar (POST).

## Descripcion de Enpoints de la API

### ***Endpoint: productos***

### localhost/web2/TPE-Web2-API/api/productos (verbo GET)

Esta url sin ningún parámetro, utilizando el verbo GET, va a listar los productos del sitio web según vienen de la base de datos.

***Uso de parámetros (siempre escribir los valores en minúsculas)***

***Parámetros "sort" y "order":***

Incorporando estos parámetros a la url podrá hacer uso de la función de ordenamiento, agregando como valor del parametro _sort_ el campo por el cual quiere ordenar los productos y como valor del parametro _order_: ASC (para ordenarlos de manera ascendente) o DESC (para ordenarlos de manera descendiente).

Se pueden ordenar los productos según los siguientes campos:

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

***Parámetro "color":***

Incorporando este parámetro a la url podrá hacer uso de la función de filtrado por color, agregando como valor del parametro _color_ el color por el cual quiere filtrar los productos.

Si quisiera filtrar los productos que sean de color rojo, la url quedaría de la siguiente manera: 
***localhost/web2/TPE-Web2-API/api/productos?color=rojo***

***Parámetro "marca":***

Incorporando este parámetro a la url podrá hacer uso de la función de filtrado por marca, agregando como valor del parametro _marca_ la marca por la cual quiere filtrar los productos.

Si quisiera filtrar los productos que sean de la marca nike, la url quedaría de la siguiente manera: 
***localhost/web2/TPE-Web2-API/api/productos?marca=nike***

***Parámetro "pagina":***

Incorporando este parámetro a la url podrá hacer uso de la función de paginación, agregando como valor del parametro _pagina_ el número de página que quiere visitar. La cantidad de productos por página está seteado en 5.

Si quisiera visitar la página número 2 y ver sus respectivos productos, la url quedaría de la siguiente manera: 
***localhost/web2/TPE-Web2-API/api/productos?pagina=2***

### localhost/web2/TPE-Web2-API/api/productos/:ID (verbo GET)

En este caso, si se le agrega a la url anterior, una barra y un ID se podrá traer el producto que posea dicho ID.

Si quisieras ver el producto con ID= 22, la url quedaría de la siguiente manera:
Eligiendo el verbo GET:
***localhost/web2/TPE-Web2-API/api/productos/22***

### localhost/web2/TPE-Web2-API/api/productos/:ID (verbo DELETE)

Utilizando el verbo DELETE y especificando el ID del producto (/ID), se podrá eliminar el producto que posea dicho ID.

Si quisieras borrar el producto con ID= 22, la url quedaría de la siguiente manera:
Eligiendo el verbo DELETE:
***localhost/web2/TPE-Web2-API/api/productos/22***

### ***Endpoint: marcas***

### localhost/web2/TPE-Web2-API/api/marcas (verbo GET)

Línea en router: ***$router->addRoute('marcas', 'GET', 'MarcasApiController', 'showMarcas');***

Esta url sin ningún parámetro, utilizando el verbo GET, va a listar las marcas cargadas en el sitio web según vienen de la base de datos.

***Uso de parámetros (siempre escribir los valores en minúsculas excepto loc_fabrica en el cual se escribe un nombre de país cuya primer letra es mayúscula)***

***Parámetros "sort" y "order":***

Incorporando estos parámetros a la url podrá hacer uso de la función de ordenamiento, agregando como valor del parametro _sort_ el campo por el cual quiere ordenar las marcas y como valor del parametro _order_: ASC (para ordenarlos de manera ascendente) o DESC (para ordenarlos de manera descendiente).

Se pueden ordenar las marcas según los siguientes campos:

- id_marcas
- nombre_marca
- fecha_creacion (ordena por año)
- loc_fabrica (ordena por país)


Si quisiera ordenar los productos por "nombre_marca" de manera ascendente, la url quedaría de la siguiente manera: 
***localhost/web2/TPE-Web2-API/api/marcas?sort=nombre_marca&order=ASC***

***Parámetro "localizacion":***

Incorporando este parámetro a la url podrá hacer uso de la función de filtrado por localización, agregando como valor del parametro _localizacion_ el país por el cual quiere filtrar las marcas.

Si quisiera filtrar las marcas cuya localización sea Argentina, la url quedaría de la siguiente manera: 
***localhost/web2/TPE-Web2-API/api/marcas?localizacion=Argentina***

***Parámetro "pagina":***

Incorporando este parámetro a la url podrá hacer uso de la función de paginación, agregando como valor del parametro _pagina_ el número de página que quiere visitar. La cantidad de marcas por página está seteado en 5.

Si quisiera visitar la página número 2 y ver sus respectivas marcas, la url quedaría de la siguiente manera: 
***localhost/web2/TPE-Web2-API/api/marcas?pagina=2***

### localhost/web2/TPE-Web2-API/api/marcas/:ID (verbo GET)

En este caso, si se le agrega a la url anterior, una barra y un ID se podrá traer la marca que posea dicho ID.

Si quisieras ver la marca con ID= 4, la url quedaría de la siguiente manera:
Eligiendo el verbo GET:
***localhost/web2/TPE-Web2-API/api/marcas/4***

## Opciones de MODIFICAR (PUT) Y AGREGAR (POST) productos o marcas

Para realizar estas acciones tiene que ser autorizado mediante la adquisición de un token.

### Adquirir el TOKEN

Para conseguir el token se tendrán que seguir los siguientes pasos:

En el Postman, seleccionando el verbo GET, se deberá hacer uso del endpoint _user/token_. La url quedaría de la siguiente forma:
***localhost/web2/TPE-Web2-API/api/user/token***

En la pestaña "Authorization" debe elegir la opción _type-> Basic auth_ y colocar el usuario y contraseña que posea como administrador.

Al enviar la consulta obtendrá un token con el cual podrá realizar las acciones de modificar y agregar productos y marcas.

### ***Endpoint: productos***

### localhost/web2/TPE-Web2-API/api/productos (verbo POST)

Para agregar un producto tendrá que incorporar el token de autorización si no lo hizo anteriormente. Para ello, en la pestaña "Autorization" elija la opción _type-> Bearer Token_ y pegue el token de autorización.

Seleccione el verbo POST y coloque la url correspondiente, en este caso: 
***localhost/web2/TPE-Web2-API/api/productos***

En la pestaña "Body" deberá colocar los valores de los siguientes campos:

```
{
    "nombre_producto": "zapatillas",
    "color": "rojo",
    "talle": 39,
    "tipo": "urbana",
    "precio": 56000,
    "url_imagenP": "http//...",
    "id_marca_fk": 22
}
```
Aclaraciones: Puede no incluir la url de la imagen y simplemente colocar doble comillas vacias (""). Puede consultar la lista de productos o la lista de marcas para saber qué "id_marca_fk" colocar según la marca de la cual sea el producto.

Por último presionar el botón "send" para realizar la acción.

### localhost/web2/TPE-Web2-API/api/productos (verbo PUT)

Para modificar un producto tendrá que incorporar el token de autorización si no lo hizo anteriormente. Para ello, en la pestaña "Autorization" elija la opción _type-> Bearer Token_ y pegue el token de autorización.

Seleccione el verbo PUT y coloque la url correspondiente, en este caso: 
***localhost/web2/TPE-Web2-API/api/productos***

En la pestaña "Body" deberá cambiar los valores de los campos que quiera modificar:

```
{
    "nombre_producto": "zapatillas",
    "color": "rojo",
    "talle": 39,
    "tipo": "urbana",
    "precio": 56000,
    "url_imagenP": "http//...",
    "id_marca_fk": 22
}
```
Aclaraciones: Puede no incluir la url de la imagen y simplemente colocar doble comillas vacias (""). Puede consultar la lista de productos o la lista de marcas para saber qué "id_marca_fk" colocar según la marca de la cual sea el producto.

Por último presionar el botón "send" para realizar la acción.

### ***Endpoint: marcas***

### localhost/web2/TPE-Web2-API/api/marcas (verbo POST)

Para agregar una marca tendrá que incorporar el token de autorización si no lo hizo anteriormente. Para ello, en la pestaña "Autorization" elija la opción _type-> Bearer Token_ y pegue el token de autorización.

Seleccione el verbo POST y coloque la url correspondiente, en este caso: 
***localhost/web2/TPE-Web2-API/api/marcas***

En la pestaña "Body" deberá colocar los valores de los siguientes campos:

```
{
    "nombre_marca": "nike",
    "fecha_creacion": "1987",
    "loc_fabrica": "España",
    "url_imagen": "https://..."
}
```
Aclaraciones: Puede no incluir la url de la imagen y simplemente colocar doble comillas vacias (""). Puede consultar la lista de productos o la lista de marcas para saber ya existe la marca que quiere agregar.

Por último presionar el botón "send" para realizar la acción.



