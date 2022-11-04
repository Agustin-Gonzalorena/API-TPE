<?php
require_once './libs/Router.php';
require_once './app/controller/products.controller.php';
require_once './app/controller/categories.controller.php';

$router = new Router();

$router->addRoute('products', 'GET', 'productsController', 'get');
$router->addRoute('products/:ID', 'GET', 'productsController', 'get');
$router->addRoute('products/:COLUMNS/:ORD', 'GET', 'productsController', 'filter');
$router->addRoute('products/:ID', 'DELETE', 'productsController', 'delete');
$router->addRoute('products', 'POST', 'productsController', 'insert');
$router->addRoute('products/:ID', 'PUT', 'productsController', 'update');

$router->addRoute('categories', 'GET', 'categoriesController', 'get');
$router->addRoute('categories/:ID', 'GET', 'categoriesController', 'get');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);