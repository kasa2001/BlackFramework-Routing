<?php


namespace BlackFramework\Routing\Factory;


use ReflectionClass;

class DefaultFactory implements IFactory
{
    public function createObject(ReflectionClass $class, array $params): object
    {
        $controllerItems = [];

        foreach ($params as $controllerParam)
        {
            $controllerItems[] = new $controllerParam();
        }

        return $class->newInstanceArgs($controllerItems);
    }

}