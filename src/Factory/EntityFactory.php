<?php


namespace BlackFramework\Routing\Factory;


use ReflectionClass;

class EntityFactory implements IFactory
{
    public function createObject(ReflectionClass $class, array $params): object
    {
        $object = $class->newInstance();

        foreach($params as $key => $param) {
            $object->$key = $param;
        }

        return $object;
    }

}