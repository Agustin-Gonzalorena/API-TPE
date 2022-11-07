
# Ash Indumentaria API

Api creada con Php y MySQL por Agustin Gonzalorena.

UNICEN-TUDAI

La tabla de productos cuenta con los siguientes campos los cuales luego podra modificar,
agregar nuevos o filtrar.

- id
- name
- description
- price
- stock
- image
- id_types
## Logging 

Para poder obtener el token de usuario:

    /API-TPE/api/auth

Si ingresa nombre de usuario y contraseña que se encuentre registrado
obtendra su token.

Este token sera requerido para comentar un producto o tambien
Para poder:

- Agregar
- Modificar
- Eliminar

un producto se debera tener que enviar un token con **permisos de administrador**.

## Productos
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

    Se debera enviar los datos de **TODOS** los campos de la tabla.
    
    Ejemplo:

        {
            "name":"nombre",
            "description":"descipcion",
            "image":"ruta de la imagen",
            "price":1100,
            "stock":2,
            "id_types":3

        }
## Filtros
- ### Paginacion:
    Para paginar use las variables GET "page" y "size" de la siguiente manera:

        /API-TPE/api/products?page=1&size=5

    La variable "page" hace referencia a la pagina de inicio.

    La variable "size" hace referencia a la cantidad de paginas que quiere mostrar.

    Si "size" supera la cantidad maxima de productos, se mostraran todos los restantes.

- ### Por productos:
    Para filtar por producto utilize la variable "filter" de la siguiente manera:

        /API-TPE/api/products?filter=remeras

    En este ejemplo le obtendra todas las remeras.

- ### Por campos de la tabla y en orden ascendente o descendente:
    Para ordenar por campo utilize la variable "column" y asigne el nombre del campo,
    tambien se debera utilizar la variable "order" para indicar si se quiere ordenar de forma ascendente o descendente:

        /API-TPE/api/products?column=name&order=a
    Puede filtrar por column= "name","stock","price".

    Si "order" toma el valor de "a" se ordenara de forma ascendente.

    Y Si "order" toma el valor de "d" se ordenara de forma descendente.
## Comentarios
- Obtendra todos los comentarios existentes, metodo GET:

        /API-TPE/api/comments

- Para obtener todos los comentarios de un producto especifico:

        /API-TPE/api/comments?id=1000

    Tendra que usar la variable GET "id" para indicar el id del producto.

- Para obtener todos los comentarios de un usuario especifico:

        /API-TPE/api/comments?user=fede

    Tendra que usar la variable GET "user" para indicar userName del usuario.

- Para obtener un comentario:

        /API-TPE/api/comments/1

    tendra que poner el id del comentario requerido.
- Si quiere agregar un comentario tendra que **enviar un token que verifique que este logeado** y utilizar el siguiente endpoint:
        
        /API-TPE/api/comments
    Tendra que mandarle por POST el comentario, la valoracion entre 1-5 y el ID del prducto de la siguiente manera:

        {

        "comment":"Aqui el comentario",

        "score":5,

        "id_product":1000

        }



## Contacto
Por cualquier consulta mande un email a:

Email: agustin_gonzalorena1@gmail.com