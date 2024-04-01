<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('session.auto_start', 1);
error_reporting(E_ALL);

define('VIEW_BASE_PATH', __DIR__ . '/../views/');

require_once __DIR__.'/../vendor/autoload.php';

use \Core\RouteResolver;
use \Core\ServiceContainer;
use \Dotenv\Dotenv;

//load .env
$dotenv = Dotenv::createImmutable(__DIR__.'/..');
$dotenv->load();

unset($_SERVER['DB_HOST']);
unset($_SERVER['DB_USER']);
unset($_SERVER['DB_PASS']);
unset($_SERVER['DB_NAME']);

//include Route.php 
require_once '../app/Route.php';

$routes = $router->getAllRoutes();
$requestMethod = $_SERVER['REQUEST_METHOD'];
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host =  $_SERVER['HTTP_HOST'];
$baseURL = $_SERVER['BASE_URL'];
$currentUrl = $protocol.$host.$_SERVER['REQUEST_URI'];

$routeURL = substr($currentUrl, strlen($baseURL));

//service container functionality
$container = new ServiceContainer();
$container->bind('Core\Request', function(){
    return new \Core\Request();
});
$container->bind('Auth', function(){
    return new \App\Middleware\Auth();
});
$container->bind('Guest', function(){
    return new \App\Middleware\Guest();
});



$routeResolver = new RouteResolver($routes, $container);
$routeResolver->handleRoute($requestMethod, $routeURL);