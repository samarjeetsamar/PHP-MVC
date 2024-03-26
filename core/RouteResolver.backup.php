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
            if(preg_match($routePattern, $requestUri, $matches)) { 

                [$controllerName, $methodName] = explode('@', $action);

                $controller = $this->container->resolve($controllerName);

                $reflection = new ReflectionMethod($controllerName, $methodName);
                $parameters = $reflection->getParameters();
                $dependencies = [];
                $args = [];
                array_shift($matches);

                foreach ($parameters as $key => $parameter) {
                    $paramName = $parameter->getName();
                    if (isset($paramName)) {
                        $args[$paramName] = $matches[$key];
                    } else {
                        $args[] = null; 
                    }
                }
                call_user_func_array([$controller, $methodName], $args);
                return;
            }
        }

        throw new Exception ('Route Not Found!!');
    }
}