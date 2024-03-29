<?php

namespace App\Repository\Interface;

interface ICategoryRepository 
{
    public function list(int $perPage = 10);
    public function all();
    public function random();
    public function findById($id);
    public function storeOrUpdate($data = [], $id = null);
    public function destroyById($id);
}