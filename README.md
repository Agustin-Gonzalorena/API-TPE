# Api Ash Indumentaria

Api creada con Php y MySQL por Agustin Gonzalorena.

UNICEN-TUDAI

La tabla cuenta con los siguientes campos los cuales luego podra modificar,
agregar nuevos o filtrar.

- id
- name
- description
- price
- stock
- image
- id_types

## Basicos
#### A continuacion se mostraran ejemplos de los endponit principales:

- Traer todos los productos, metodo=GET:

        /API-TPE/api/products

- Traer un producto por ID, metodo=GET:

        /API-TPE/api/products/1000

- Eliminar un producto por ID, metodo=DELETE:

        /API-TPE/api/products/1000

- Modifique un producto por ID, metodo=PUT:

        /API-TPE/api/products/1000

    Se debera enviar los datos a modificar siguiendo los campos de la tabla.

- Agregar un producto, metodo=POST:

        /API-TPE/api/products

    Se debera enviar los datos de TODOS los campos de la tabla.

## Filtros
### Paginacion:
Para paginar use las variables GET "page" y "size" de la siguiente manera:

    /API-TPE/api/products?page=1&size=5

La variable "page" hace referencia a la pagina de inicio.

La variable "size" hace referencia a la cantidad de paginas que quiere mostrar.

Si "size" supera la cantidad maxima de productos, se mostraran todos.

### Por productos:
Para filtar por producto utilize la variable "filter" de la siguiente manera:

    /API-TPE/api/products?filter=remeras

En este ejemplo le obtendra todas las remeras.

### Por campos de la tabla y en orden ascendente o descendente:
Para ordenar por campo utilize la variable "column" y asigne el nombre del campo,
tambien se debera utilizar la variable "order" para indicar si se quiere ordenar de forma ascendente o descendente:

    /API-TPE/api/products?column=name&order=a

Si "order" toma el valor de "a" se ordenara de forma ascendente.

Y Si "order" toma el valor de "d" se ordenara de forma descendente.