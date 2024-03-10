<?php

namespace App\Repository\Interface;

interface IEventRepository 
{
    public function list(int $perPage = 10);
    public function listPending(int $perPage = 10);
    public function listPublished(int $perPage = 10);
    public function listRejected(int $perPage = 10);
    public function accepte($id);
    public function reject($id);
    public function listByUser($userId, $perPage = 10);
    public function findById($id);
    public function storeOrUpdate($data = [], $id = null);
    public function destroyById($id);

    public function search($search,array $category = null);
}
