<?php 

$router =  Core\Router::getInstance();

//Auth routes 
$router->post('/register', 'App\Controllers\Auth\RegisterController@create')->name('register');
$router->get('/login', 'App\Controllers\Auth\LoginController@showLogin')->name('showLoginForm')->only('Guest');
$router->post('/login', 'App\Controllers\Auth\LoginController@login')->name('login');
$router->post('/logout', 'App\Controllers\Auth\LoginController@logout')->name('logout');

$router->get('/', 'App\Controllers\HomeController@index')->name('home');
$router->get('/form-validate', 'App\Controllers\HomeController@getValidationForm');
$router->post('/form-validate-post', 'App\Controllers\HomeController@postValidationForm')->name('formValidatePost');


$router->get('/dashboard', 'App\Controllers\HomeController@dashboard')->name('dashboard')->only('Auth');
$router->get('/register', 'App\Controllers\Auth\RegisterController@register')->name('User')->only('Guest');
$router->get('/user/{id:int}', 'App\Controllers\UserController@show')->name('show.user');
$router->get('/user/{id:int}/edit', 'App\Controllers\UserController@edit')->name('user.edit');
$router->post('/user/update/{id:int}', 'App\Controllers\UserController@update')->name('user.update');
$router->get('/user/{id:int}/edit/{ssssid:int}', 'App\Controllers\UserController@editWP')->name('edit.wp');
$router->get('/user/{id:int}/delete', 'App\Controllers\UserController@delete')->name('user.delete');
$router->get('/user/{username:string}', 'App\Controllers\UserController@showUserByUserName');
$router->get('/users', 'App\Controllers\UserController@allUsers')->name('users')->only('Auth');
$router->get('/about', 'App\Controllers\AboutController@index');
$router->get('/contact', 'App\Controllers\ContactController@index')->name('contactFormView');
$router->post('/contact', 'App\Controllers\ContactController@submitForm')->name('AddContactForm');

$router->get('/test', 'App\Controllers\TestController@test')->name('test');
$router->get('/post', 'App\Controllers\PostController@create')->name('post.create');
$router->post('/post', 'App\Controllers\PostController@store')->name('post.store');
$router->get('/post/{slug:string}', 'App\Controllers\PostController@show')->name('post.show');

$router->get('/user/profile/{name:string}', 'App\Controllers\UserController@profile')->name('user.profile');
$router->get('/user-posts', 'App\Controllers\PostController@getPostsByUser')->name('user.posts');

$router->get('/testing/{id:20}', 'App\Controllers\TestingController@index');

$router->get('/clear-session', function(){
    unset($_SESSION);
    session_destroy();
    echo 'session cleared!!!';
});










