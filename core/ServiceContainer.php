<?php
namespace Core;

class ServiceContainer {


    private $bindings = [];

    public function bind($name, $resolver) {
        $this->bindings[$name] = $resolver;
    }

    public function make($name) {
        if (isset($this->bindings[$name])) {
            return $this->bindings[$name]($this);
            
        }
        // If no binding exists, try to auto-resolve the class
        return $this->resolve($name);
    }

    public function resolve($name) {

        $reflector = new \ReflectionClass($name);

        // Check if the class is instantiable
        if (! $reflector->isInstantiable()) {
            throw new \Exception("Class {$name} is not instantiable.");
        }

        // Get the constructor, if available
        $constructor = $reflector->getConstructor();

        // If there is no constructor, just instantiate the class
        if (is_null($constructor)) {
            return new $name;
        }

        // Resolve the constructor parameters
        $parameters = $constructor->getParameters();
        $dependencies = $this->resolveDependencies($parameters);

        // Create a new instance with dependencies
        return $reflector->newInstanceArgs($dependencies);
    }

    public function resolveDependencies(array $parameters) {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $type = $parameter->getType();

            if ($type && !$type->isBuiltin()) {
                // Resolve class dependency
                $dependencies[] = $this->make($type->getName());
            } else {
                // Handle missing dependencies or primitive types
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new \Exception("Cannot resolve dependency {$parameter->name}");
                }
            }
        }

        return $dependencies;
    }

}