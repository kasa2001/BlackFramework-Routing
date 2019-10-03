<?php


namespace BlackFramework\Routing\Factory;

use ReflectionClass;

interface IFactory
{
    /**
     * @param ReflectionClass $class
     * @param array $params
     * @return mixed
     */
    public function createObject(ReflectionClass $class, array $params): object;
}