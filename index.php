<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('session.auto_start', 1);
error_reporting(E_ALL);


require_once __DIR__.'/vendor/autoload.php';

use Core\Router;
use Core\RouteResolver;
use Core\ServiceContainer;
use Core\View;
use Core\Request;
use App\Middleware\Auth;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router =  Router::getInstance();
$authMiddleware = new Auth();


//Login route
$router->post('/user/create', 'App\Controllers\Auth\RegisterController@create')->name('create.user');
$router->get('/login', 'App\Controllers\Auth\LoginController@showLogin')->name('showLoginForm')->middleware('Auth');
$router->post('/login', 'App\Controllers\Auth\LoginController@login')->name('login');
$router->post('/logout', 'App\Controllers\Auth\LoginController@logout')->name('logout');

$router->get('/', 'App\Controllers\HomeController@index')->name('home');
$router->get('/form-validate', 'App\Controllers\HomeController@getValidationForm')->name('formValidate');
$router->post('/form-validate-post', 'App\Controllers\HomeController@postValidationForm')->name('formValidatePost');


//dashboard
$router->get('/dashboard', 'App\Controllers\HomeController@dashboard')->name('dashboard')->middleware('Auth');
$router->middleware('AgeCheckMiddleware')->get('/user', 'App\Controllers\UserController@index')->name('User');
$router->get('/user/{id:int}', 'App\Controllers\UserController@show')->name('show.user');
$router->get('/user/{id:int}/edit', 'App\Controllers\UserController@edit')->name('user.edit');
$router->post('/user/update/{id:int}', 'App\Controllers\UserController@update')->name('user.update');
$router->get('/user/{id:int}/edit/{ssssid:int}', 'App\Controllers\UserController@editWP')->name('edit.wp');
$router->get('/user/{id:int}/delete', 'App\Controllers\UserController@delete')->name('user.delete');
$router->get('/user/{username:string}', 'App\Controllers\UserController@showUserByUserName');
$router->get('/users', 'App\Controllers\UserController@allUsers')->name('users');
$router->get('/about', 'App\Controllers\AboutController@index');
$router->get('/contact', 'App\Controllers\ContactController@index')->name('contactFormView');
$router->post('/contact', 'App\Controllers\ContactController@submitForm')->name('AddContactForm');

$router->get('/test/{id:int}', function(Request $request, $id){
    print_r($request->all());
    View::render('views/test.php', ['id' => $id]);
});


$routes = $router->getAllRoutes();
$requestMethod = $_SERVER['REQUEST_METHOD'];
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host =  $_SERVER['HTTP_HOST'];
$baseURL = $_SERVER['BASE_URL'];

$currentUrl = $protocol.$host.$_SERVER['REQUEST_URI'];
$routeURL = substr($currentUrl, strlen($baseURL));

$container = new ServiceContainer();

$container->bind('Core\Request', function(){
    return new \Core\Request();
});

$routeResolver = new RouteResolver($routes, $container);
$routeResolver->handleRoute($requestMethod, $routeURL);