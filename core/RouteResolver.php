<?php 

namespace Core;
use ReflectionMethod;
use Exception;

class RouteResolver {
    private $routes;
    private $container;

    public function __construct($routes, $container) {
        $this->routes = $routes;
        $this->container = $container;
    }

    public function handleRoute($route) {
        if (isset($this->routes[$route])) {
            [$controllerName, $methodName] = explode('@', $this->routes[$route]);
            $controller = $this->container->resolve($controllerName);

            // Inject dependencies
            $reflection = new ReflectionMethod($controllerName, $methodName);
            $parameters = $reflection->getParameters();
            $dependencies = [];
            foreach ($parameters as $parameter) {
                $dependencies[] = $this->container->resolve($parameter->getType()->getName());
            }

            // Invoke controller method with dependencies
            
            call_user_func_array([$controller, $methodName], $dependencies);
        } else {
            
            throw new Exception('Route not found!!');
            // Handle not found
        }
    }
}