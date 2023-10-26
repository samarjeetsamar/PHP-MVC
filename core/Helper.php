<?php

use Core\Router;
use Core\Session;
use Core\Request;

function route($routeName, $params = []) {

    $baseURL = $_SERVER['BASE_URL'];
    $router = Router::getInstance();
    
    $generatedRouteURL = $router->generateURL($routeName, $params);
    return $baseURL.$generatedRouteURL;
}

function redirectBack() {

    $preURL = Session::previousURL();
    if($preURL){
        header('Location: ' . $preURL);
        exit();
    }else {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

function redirectBackWithErrors(array $errors) {
    session_start();
    $_SESSION['errors'] = $errors;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function redirectWithSuccessMsg(string $message){
    session_start();
    $_SESSION['success'] = $message;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function redirectToDashboard(){
    
    if(isset($_SESSION['user_id'])) {
        header('Location: http://localhost/learning/php/MVC/dashboard');
        exit;
    }
}

function redirectWithErrorMsg( $msg){
    session_start();
    $_SESSION['resp'] = $msg;
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

function redirect($url, $statusCode = 302) {
    header('Location: ' . $url, true, $statusCode);
    exit;
}



   
