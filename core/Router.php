<?php
namespace Core;

use App\Controllers\HomeController;
use Core\Request;
use dotenv;
class Router {

    public $baseURL;
 
    public $routes = [];

    protected $namedRoutes = [];

    public function name($name, $route) {
        $this->namedRoutes[$name] = $route;
        return $this; // Allow method chaining
    }

    public function __construct(){
        $this->baseURL = $_ENV['BASE_URL'];
    }
    
    public function addRoute($method, $pattern, $action) {
        $this->routes[$method][$pattern] = $action;
    }

    public function getAllRoutes(){
        return $this->routes;
    }

    public  function get($pattern, $action) {
        $this->addRoute('GET', $pattern, $action);
    }

    public  function post($pattern, $action) {
        $this->addRoute('POST', $pattern, $action);
    }

    public  function put($pattern, $action) {
        $this->addRoute('PUT', $pattern, $action);
    }

    public  function patch($pattern, $action) {
        $this->addRoute('PATCH', $pattern, $action);
    }

    public  function delete($pattern, $action) {
        $this->addRoute('DELETE', $pattern, $action);
    }


    public  function match($requestUrl, $requestMethod) {
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

    public  function getRouteParameters($requestUrl) {
        $routeParams = [];

        if (isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
           
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $pattern => $action) {
                // Convert {param} placeholders in pattern to regular expressions.
                $pattern = preg_replace('/\{(\w+)\}/', '(?P<\$1>[^/]+)', $pattern);

               

                // Add delimiters and make it case-insensitive.
                $pattern = '/^' . $pattern . 'i';

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

    public function generateURL($name, $params = []) {
        if (isset($this->namedRoutes[$name])) {
            $url = $this->namedRoutes[$name];
            foreach ($params as $param => $value) {
                $url = str_replace("{{$param}}", $value, $url);
            }
            return $url;
        } else {
            // If the route name is not found, check if it's a regular URL
            foreach ($this->namedRoutes as $namedRoute) {
                if ($namedRoute === $name) {
                    return $name;
                }
            }
        }
        return ''; // Handle invalid route names or URLs
    }



}
