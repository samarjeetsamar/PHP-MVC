<?php
namespace Core;

use App\Controllers\HomeController;
use Core\Request;

class Route {

    private static $routes = [];

    public static function addRoute($url, $controllerAction) {
        self::$routes[$url] = $controllerAction;
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

}
