<?php
require_once './libs/Router.php';
require_once './app/controller/products.controller.php';
require_once './app/controller/auth.controller.php';

$router = new Router();

$router->addRoute('products', 'GET', 'productsController', 'getAll');
$router->addRoute('products/:ID', 'GET', 'productsController', 'getById');
$router->addRoute('products/:ID', 'DELETE', 'productsController', 'delete');
$router->addRoute('products', 'POST', 'productsController', 'insert');
$router->addRoute('products/:ID', 'PUT', 'productsController', 'update');

$router->addRoute('auth','GET','authController','getToken');


$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);