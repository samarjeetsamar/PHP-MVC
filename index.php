<?php
require_once __DIR__.'/vendor/autoload.php';

use Core\Router;
use Core\RouteResolver;
use Core\ServiceContainer;

// Router::addRoute('about', 'AboutController@index');
// Router::dispatch('about');

$routes = [
    'index' => 'App\Controllers\HomeController@index',
    'about' => 'App\Controllers\AboutController@index',
    'users' => 'App\Controllers\UserController@allUsers',
];



$baseURL = '/learning/php/MVC/';
$currentUrl = $_SERVER['REQUEST_URI'];
$route = str_replace($baseURL, '', $currentUrl);


$container = new ServiceContainer();
$routeResolver = new RouteResolver($routes, $container);
$routeResolver->handleRoute($route);








