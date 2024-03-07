<?php

namespace App\Repository;

use App\Models\Role;
use App\Repository\Interface\IRoleRepository;

class RoleRepository implements IRoleRepository
{

    public function list(int $perPage = 10)
    {
        return Role::paginate($perPage);
    }

    public function findById($id)
    {
        //fetch single role
        return Role::find($id);
    }

    public function storeOrUpdate($data = [], $id = null)
    {
        //store or update the role
        if ($id) {
            $role = Role::find($id);
            $role->update($data);
            return $role;
        } else {
            return Role::create($data);
        }
    }

    public function destroyById($id)
    {
        //delete role
        $role = Role::find($id);
        return $role->delete();
    }
}
