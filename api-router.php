<?php
require_once './libs/Router.php';
require_once './app/controller/products.controller.php';
require_once './app/controller/auth.controller.php';
require_once './app/controller/commentsController.php';

$router = new Router();

$router->addRoute('products', 'GET', 'productsController', 'getAll');
$router->addRoute('products/:ID', 'GET', 'productsController', 'getById');
$router->addRoute('products/:ID', 'DELETE', 'productsController', 'delete');
$router->addRoute('products', 'POST', 'productsController', 'insert');
$router->addRoute('products/:ID', 'PUT', 'productsController', 'update');

$router->addRoute('comments','GET','commentsController','get');
$router->addRoute('comments/:ID','GET','commentsController','getById');
$router->addRoute('comments','POST','commentsController','insert');

$router->addRoute('auth','GET','authController','getToken');

$router->setDefaultRoute('productsController','errorEndpoint');//es necesario un controlador nuevo?

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);