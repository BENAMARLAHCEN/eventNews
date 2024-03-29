<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasPermissionsTrait
{

    public function assignRole(...$roles)
    {
        $roles = $this->getAllRoles($roles);
        if ($roles === null) {
            return $this;
        }
        $this->roles()->saveMany($roles);
        return $this;
    }


    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions[0]);
        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }




    public function blockPermissionsTo(...$permissions)
    {

        $permissions = $this->getAllPermissions($permissions[0]);
        if ($permissions === null) {
            return $this;
        }
        $this->blockedPermissions()->saveMany($permissions);
        return $this;
    }

    public function refreshBlokedPermissions(...$permissions)
    {
        $this->blockedPermissions()->detach();
        return $this->blockPermissionsTo($permissions[0]);
    }

    public function hasBlockedPermission($permission){
        return (bool) $this->blockedPermissions->where('name', $permission)->count();
    }

    public function hasBlockedPermissionTo($permission)
    {
        return (bool) $this->blockedPermissions->where('name', $permission->name)->count();
    }


    public function refreshPermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions[0]);
    }




    public function withdrawPermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }






    // has function

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }

    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }


    public function hasPermissionThroughRole($permission)
    {
        foreach ($permission->roles as $role) {
            if ($this->roles->contains($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasPermissionTo($permission)
    {
        return ($this->hasPermissionThroughRole($permission) || $this->hasPermission($permission)) && !$this->hasBlockedPermissionTo($permission);
    }

    public function userPermissions()
    {

        $permissions = array_merge($this->permissions->pluck('name')->toArray(), $this->roles->map->permissions->flatten()->pluck('name')->toArray());
        $blockedPermissions = $this->blockedPermissions->pluck('name')->toArray();
        $filteredPermissions = array_diff($permissions, $blockedPermissions);
        return $filteredPermissions;
    }

    // get all roles and permissions from the database


    public function getAllRoles(array $roles)
    {
        return Role::whereIn('name', $roles)->get();
    }

    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }



    // roles, permission and blockedPermission relashin
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }

    public function blockedPermissions()
    {
        return $this->belongsToMany(Permission::class, 'blocked_permissions');
    }
}
