<?php
namespace Core;

use Core\Request;

class ServiceContainer {


    private $bindings = [];

    public function bind($name, $resolver) {
        $this->bindings[$name] = $resolver;
    }

    public function resolve($name) {

        if (isset($this->bindings[$name])) {
            $resolver = $this->bindings[$name];
            return $resolver();
        }
        throw new \Exception("Service '$name' not found in the container.");
    }


    // public function resolve($className) {
    //     // Implement class instantiation and dependency resolution here
    //     if ($className === 'Request') {
    //         return new Request();
    //     }
    //     // echo $className;
    //     // exit;
    //     // Handle other dependencies
    //     return new $className();
    // }
}