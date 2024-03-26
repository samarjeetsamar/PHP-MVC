<?php 

namespace Core;
use ReflectionMethod;
use Exception;

use Core\Router;

class RouteResolver extends Router{
    public $routes;
    public $container;

    public function __construct($routes, $container) {
        $this->routes = $routes;
        $this->container = $container;

    }

    public function handleRoute($requestMethod, $requestUri) {

        foreach($this->routes[$requestMethod] as $route => $action) {
            $routePattern =  $this->routeToPattern($route);

            
            if(preg_match($routePattern, $requestUri , $matches)) { 
                $dependencies = array_slice($matches, 1);
                if(is_string($action)){
                    [$controllerName, $methodName] = explode('@', $action);
                    $controller = $this->container->resolve($controllerName);
                    call_user_func_array([$controller, $methodName], $dependencies );
                }else if(is_callable($action )){
                    //$action();
                    call_user_func_array($action, $dependencies);
                }else {
                    throw new Exception('Invalid route action type!');
                }
                return;
            }
        }

        throw new Exception ('Invalid URL !!');
    }
}