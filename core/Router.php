<?php
namespace Core;

use App\Controllers\HomeController;
use Core\Request;

class Router {

    // private static $routes = [];

    private $routes = [];

    // public static function addRoute($url, $controllerAction) {
    //     self::$routes[$url] = $controllerAction;
    // }

    private function addRoute($method, $pattern, $action) {
        $this->routes[$method][$pattern] = $action;
    }

    public static function dispatch($url) {
        if (array_key_exists($url, self::$routes)) {
            $controllerAction = self::$routes[$url];
            list($controllerName, $methodName) = explode('@', $controllerAction);
            
            
           
            // Create an instance of the controller and call the method
            // $controller = new $controllerName();

            $controllerClass = "App\\Controllers\\" . $controllerName;
            $controllerInstance = (new \ReflectionClass($controllerClass))->newInstance();

            // Call the method on the controller instance
            $controllerInstance->$methodName();
            

            // $controller->$methodName();
        } else {
            echo "404 - Page not found";
        }
    }

    public static function getAllRoutes(){
        return self::$routes;
    }


    

    public function get($pattern, $action) {
        $this->addRoute('GET', $pattern, $action);
    }

    public function post($pattern, $action) {
        $this->addRoute('POST', $pattern, $action);
    }

    public function put($pattern, $action) {
        $this->addRoute('PUT', $pattern, $action);
    }

    public function patch($pattern, $action) {
        $this->addRoute('PATCH', $pattern, $action);
    }

    public function delete($pattern, $action) {
        $this->addRoute('DELETE', $pattern, $action);
    }


    public function match($requestUrl, $requestMethod) {
        if (isset($this->routes[$requestMethod])) {
            foreach ($this->routes[$requestMethod] as $pattern => $action) {
                // Convert {param} placeholders in pattern to regular expressions.
                $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $pattern);

                // Add delimiters and make it case-insensitive.
                $pattern = '/^' . $pattern . '$/i';

                if (preg_match($pattern, $requestUrl, $matches)) {
                    return $action;
                }
            }
        }

        // Return a default action for 404 Not Found.
        return 'NotFoundController@notFound';
    }

    public function getRouteParameters($requestUrl) {
        $routeParams = [];

        if (isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $pattern => $action) {
                // Convert {param} placeholders in pattern to regular expressions.
                $pattern = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $pattern);

                // Add delimiters and make it case-insensitive.
                $pattern = '/^' . $pattern . '$/i';

                if (preg_match($pattern, $requestUrl, $matches)) {
                    // Extract named parameters from the URL.
                    foreach ($matches as $key => $value) {
                        if (is_string($key)) {
                            $routeParams[$key] = $value;
                        }
                    }
                    break; // Stop after the first match.
                }
            }
        }

        return $routeParams;
    }




}
