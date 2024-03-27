<?php 

namespace Core;
use Exception;

use Core\Router;
use App\Exceptions\NotFoundException;

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
            
            // Remove query string from URL 
            $requestUri =  strtok($requestUri, '?') ;
            
            if(preg_match($routePattern, $requestUri , $matches)) { 

                $dependencies = [];
                if(is_string($action)){
                    [$controllerName, $methodName] = explode('@', $action);
                    $controllerName = new $controllerName();
                    $reflector = new \ReflectionMethod($controllerName, $methodName);
                }else if(is_callable($action)){
                    //$parameters = func_get_args(); 
                    $reflector = new \ReflectionFunction($action);
                }else {
                    throw new Exception('Invalid route action type!');
                }
                
                $parameters = $reflector->getParameters();
                
                foreach ($parameters as $parameter) {
                    $type = $parameter->getType();
                    if ($type !== null) {
                        $dependencyClassName = $type->getName();
                        if ($dependencyClassName !== null) {
                            $dependencies[] = $this->container->resolve($dependencyClassName);
                        }
                    }
                }

                $arguments = array_slice($matches, 1);
                foreach($arguments as $argument){
                    $dependencies[] = $argument;
                }
                
                if(is_string($action)){
                    call_user_func_array([$controllerName, $methodName], $dependencies);
                }else if(is_callable($action)){
                    call_user_func_array($action, $dependencies);
                }
                return;
            }
        }

        throw new NotFoundException('Route Not Found');
    }
}