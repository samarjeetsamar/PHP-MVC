<?php
namespace Core;

use Core\Request;

class ServiceContainer {
    public function resolve($className) {
        // Implement class instantiation and dependency resolution here
        if ($className === 'Request') {
            return new Request();
        }
        
        // Handle other dependencies
        return new $className();
    }
}