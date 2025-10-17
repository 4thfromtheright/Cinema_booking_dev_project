<?php

namespace App\Factory;

interface FactoryInterface
{
    public function create(array $data);
    public function getById($id);
    public function getBy(array $criteria);

    public function findAll();
}
