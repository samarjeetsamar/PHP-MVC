<?php 

namespace Core;
use Exception;

use Core\Router;
use App\Exceptions\NotFoundException;
use Core\View;

class RouteResolver extends Router{
    public $routes;
    public $container;

    public function __construct($routes, $container) {
        $this->routes = $routes;
        $this->container = $container;
    }

    public function handleRoute($requestMethod, $requestUri) {

        try {
            // $lastKey = end(array_keys($this->routes)); 
            foreach($this->routes as $key => $route){
            
                $routePattern =  $this->routeToPattern($route['pattern']);
                $action = $route['action'];
                // Remove query string from URL 
                $requestUri =  strtok($requestUri, '?') ;
                if( $requestMethod == $route['method'] && preg_match($routePattern, $requestUri , $matches)) { 

                    if($route['middleware']) {
                        $middlewares = is_array($route['middleware']) ? $route['middleware'] : [$route['middleware']];
                        foreach ($middlewares as $middleware) {

                            // Resolve the middleware instance
                            $middlewareInstance = $this->container->make($middleware);
                            if (method_exists($middlewareInstance, 'handle')) {
                                $middlewareInstance->handle();
                            } else {
                                throw new Exception("Middleware {$middleware} does not have a handle method.");
                            }
                        }
                    }
                
    
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

            throw new NotFoundException('The page you are looking for could not be found', 404);
        }catch (NotFoundException $e) {
            View::render('404.php', ['errorMsg' => $e->getMessage(), 'code' => $e->getCode()]);
            exit;
        }
    }
}