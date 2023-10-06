<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__.'/vendor/autoload.php';

use Core\Router;
use Core\RouteResolver;
use Core\ServiceContainer;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new Router;

$router->get('/', 'App\Controllers\HomeController@index');
$router->get('/user', 'App\Controllers\UserController@index');
$router->post('/user', 'App\Controllers\UserController@store');
$router->get('/user/{id}', 'App\Controllers\UserController@show');
$router->get('/user/{id}/edit', 'App\Controllers\UserController@edit');
$router->get('/user/{id}/edit/{uid}', 'App\Controllers\UserController@editWP');

$router->get('user/{username}', 'App\Controllers\UserController@showUserByUserName');

$router->get('/users', 'App\Controllers\UserController@allUsers');
$router->get('/about', 'App\Controllers\AboutController@index');
$router->get('/contact', 'App\Controllers\ContactController@index');
$router->post('/contact', 'App\Controllers\ContactController@submitForm');

$routes = $router->getAllRoutes();

$requestMethod = $_SERVER['REQUEST_METHOD'];

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host =  $_SERVER['HTTP_HOST'];
$baseURL = $_SERVER['BASE_URL'];


$currentUrl = $protocol.$host.$_SERVER['REQUEST_URI'];
$routeURL = substr($currentUrl, strlen($baseURL));

$container = new ServiceContainer();
$routeResolver = new RouteResolver($routes, $container);
$routeResolver->handleRoute($requestMethod, $routeURL);