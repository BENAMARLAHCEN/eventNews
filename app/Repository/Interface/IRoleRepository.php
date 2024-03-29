<?php

namespace App\Repository\Interface;

interface IRoleRepository 
{
    public function list(int $perPage = 10);
    public function findById($id);
    public function storeOrUpdate($data = [], $id = null);
    public function destroyById($id);
}