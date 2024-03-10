<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_roles');
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
    
    public function refreshPermissions(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermissionsTo($permissions[0]);
    }



    protected function getAllPermissions(array $permissions)
    {
        return Permission::whereIn('name', $permissions)->get();
    }

    public function hasPermission(...$permissions)
    {
        foreach ($permissions as $permission) {
            if ($this->permissions->contains('name', $permission)) {
                return true;
            }
        }
        return false;
    }
    
}
