<?php


namespace BlackFramework\Routing\Repository;


interface IRepository
{

    public function findEntity(array $params): array;
}