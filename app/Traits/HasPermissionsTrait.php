<?php

namespace App\Traits;

use App\Models\Role;
use App\Models\Permission;

trait HasPermissionsTrait
{
    public function givePermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        if ($permissions === null) {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function userPermissions()
    {
        return array_merge($this->permissions->toArray(), $this->roles->map->permissions->flatten()->toArray());
    }


    public function blockedPermissions()
    {
        return $this->belongsToMany(Permission::class, 'blocked_permissions');
    }

    public function blockPermissionsTo(...$permissions)
    {

        $permissions = $this->getAllPermissions($permissions);
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

    public function hasBlockedPermission($permission)
    {
        if (is_object($permission) && property_exists($permission, 'name')) {
            return (bool) $this->blockedPermissions->where('name', $permission->name)->count();
        }
        return false;
    }



    public function withdrawPermissionsTo(...$permissions)
    {
        $permissions = $this->getAllPermissions($permissions);
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function refreshPermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions);
    }

    public function hasPermissionTo($permission)
    {
        return ($this->hasPermissionThroughRole($permission) || $this->hasPermission($permission)) && !$this->blockedPermissions->contains($permission);
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

    public function hasRole(...$roles)
    {
        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
        }
        return false;
    }


    public function assignRole(...$roles)
    {
        $roles = $this->getAllRoles($roles);
        if ($roles === null) {
            return $this;
        }
        $this->roles()->saveMany($roles);
        return $this;
    }

    public function getAllRoles(array $roles)
    {
        return Role::whereIn('name', $roles)->get();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'users_roles');
    }
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions');
    }
    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }
}
