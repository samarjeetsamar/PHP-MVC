<?php
namespace Core;


class Router {

    public $baseURL;
 
    public $routes = [];

    public $namedRoutes = [];

    private static $instance;

    public $currentRoute;

    public $middlewares = [];

    public function __construct(){
        $this->baseURL = $_ENV['BASE_URL'];
    }

    public function middleware($middlewareName) {
        // Add middleware to the list
        $this->middlewares[] = $middlewareName;
        
        return $this;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Router();
        }
        return self::$instance;
    }

    

    public function name($name)
    {
        if (!empty($this->currentRoute)) {
            // Map the route name to the current route pattern and method.
            $this->namedRoutes[$name] = [
                'method' => $this->currentRoute['method'],
                'pattern' => $this->currentRoute['pattern'],
            ];
        }

        return $this;
    }

    
    public function addRoute($method, $pattern, $action) {

        //$this->routes[$method][$pattern] = $action;
        $this->routes[] = [
            'method' => $method,
            'pattern' => $pattern,
            'action' => $action,
            'middleware' => null
        ];
        
        $this->currentRoute = [
            'method' => $method,
            'pattern' => $pattern,
        ];
        return $this;
        
    }

    public function only($key){
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;
        return $this;
    }

    public function getAllRoutes(){
        return $this->routes;
    }

    public  function get($pattern, $action) {
        return $this->addRoute('GET', $pattern, $action);
    }

    public  function post($pattern, $action) {
        return $this->addRoute('POST', $pattern, $action);
    }

    public  function put($pattern, $action) {
        return $this->addRoute('PUT', $pattern, $action);
    }

    public  function patch($pattern, $action) {
        return $this->addRoute('PATCH', $pattern, $action);
    }

    public  function delete($pattern, $action) {
        return $this->addRoute("DELETE", $pattern, $action);
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
            $pattern = $this->namedRoutes[$name]['pattern'];
            $pattern = preg_replace_callback('/\{(\w+):(\w+)\}/', function ($matches) use (&$params) {
                $paramName = $matches[1];
                if (isset($params[$paramName])) {
                    $paramValue = $params[$paramName];
                    unset($params[$paramName]); // Remove the processed parameter.
                    return $paramValue;
                }
                return '';
            }, $pattern);
            $pattern .=  implode('/', $params);

            return $pattern;
        } else {
            // Handle the case where the route name is not found.
            echo "Route Not found";
            exit;
        }
    }

    protected function routeToPattern($route) {

        $routePattern = preg_replace_callback('/\{(\w+):(\w+)\}/', function ($matches) {
            $paramName = $matches[1];
            $paramType = $matches[2];

            switch ($paramType) {
                case 'int':
                    return '(\d+)';
                case 'string':
                    return '([a-zA-Z]+)'; 
                default:
                    return '(\w+)'; 
            }
        }, $route);

        $routePattern = '#^' . $routePattern . '$#';
        return $routePattern;
    }

    public function getPattern($param){
        return "/{{$param}:(\w+)}/";
    }

   
}
