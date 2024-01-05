<?php

declare(strict_types=1);

namespace Emmanuelc\FootballStatistic\Framework;

use ReflectionClass, ReflectionNamedType;
use Emmanuelc\FootballStatistic\Framework\Exception\ContainerException;

class Container
{
    private array $definitions = [];

    private array $resolved = [];

    public function addDefinitions(array $definitions)
    {
        $this->definitions = array_merge($this->definitions, $definitions);
    }

    public function resolve($className)
    {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerException("This class is not instantiable");
        }

        $constructor = $reflectionClass->getConstructor();

        if ($constructor === null) {
            return new $className();
        }

        $constructorParameters = $constructor->getParameters();

        if (count($constructorParameters) === 0) {
            return new $className();
        }

        $dependencies = [];

        foreach ($constructorParameters as $param) {

            $type = $param->getType();
            $name = $param->getName();
            if (!$type) {
                throw new ContainerException("Param {$name} in not valid");
            }

            if (!$type instanceof ReflectionNamedType  || $type->isBuiltin()) {
                throw new ContainerException("Param {$name} in not valid");
            }

            $dependencies[] = $this->getDependency($type->getName());
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    private function getDependency($className)
    {
        if (!array_key_exists($className, $this->definitions)) {
            throw new ContainerException("Param {$className} has no any definition");
        }

        if (array_key_exists($className, $this->resolved)) {
            return $this->resolved[$className];
        }

        $factory = $this->definitions[$className];
        $this->resolved[$className] = $factory();

        return $this->resolved[$className];
    }
}
