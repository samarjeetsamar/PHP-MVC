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

function array_flatten($array) { 
    if (!is_array($array)) { 
      return false; 
    } 
    $result = array(); 
    foreach ($array as $key => $value) { 
      if (is_array($value)) { 
        $result = array_merge($result, array_flatten($value)); 
      } else { 
        $result = array_merge($result, array($key => $value));
      } 
    } 
    return $result; 
}

 function dd($data = null){
    echo "<pre>";
    var_dump($data);
    echo "<pre/>";
    exit();
}

   
