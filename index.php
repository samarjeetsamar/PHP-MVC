<?php
require_once __DIR__.'/vendor/autoload.php';

use Core\Route;
use Core\RouteResolver;
use Core\ServiceContainer;


Route::addRoute('about', 'AboutController@index');
Route::dispatch('about');

$routes = [
    '/index' => 'App\Controllers\HomeController@index',
    '/about' => 'App\Controllers\AboutController@index',
];

$route = $_SERVER['REQUEST_URI'];
$routeResolver = new RouteResolver($routes, new ServiceContainer());
$routeResolver->handleRoute($route);








