<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    public function run(): void
    {

        Role::create(['name' => 'admin'], ['name' => 'organizer'], ['name' => 'spectator']);

        Permission::create(['name' => 'create-event'], ['name' => 'update-event'], ['name' => 'delete-event'], ['name' => 'view-event'], ['name' => 'view-any-event'], ['name' => 'create-category'], ['name' => 'update-category'], ['name' => 'delete-category'], ['name' => 'view-category'], ['name' => 'view-any-category'], ['name' => 'create-reservation'], ['name' => 'update-reservation'], ['name' => 'delete-reservation'], ['name' => 'view-reservation'], ['name' => 'view-any-reservation'], ['name' => 'create-user'], ['name' => 'update-user'], ['name' => 'delete-user'], ['name' => 'view-user'], ['name' => 'view-any-user'], ['name' => 'create-role'], ['name' => 'update-role'], ['name' => 'delete-role'], ['name' => 'view-role'], ['name' => 'view-any-role'], ['name' => 'create-permission'], ['name' => 'update-permission'], ['name' => 'delete-permission'], ['name' => 'view-permission'], ['name' => 'view-any-permission'],['access-dashboard'],['access-profile'],['access-settings'],['access-roles'],['access-permissions'],['access-users'],['access-events'],['access-reservations'],['access-categories'],['access-statistics'],['edit-profile']);
        // $permission = new Permission();
        // $permission->name = 'create-post';
        // $permission->save();

        // $role = new Role();
        // $role->name = 'admin';
        // $role->save();
        // $role->permissions()->attach($permission);
        // $permission->roles()->attach($role);

        // $permission = new Permission();
        // $permission->name = 'create-user';
        // $permission->save();

        // $role = new Role();
        // $role->name = 'organizer';
        // $role->save();
        // $role->givePermissionsTo($permission);
        // $permission->roles()->attach($role);

        // $admin = Role::where('name', 'admin')->first();
        // $userRole = Role::where('name', 'user')->first();
        // $create_post = Permission::where('name', 'create-post')->first();
        // $create_user = Permission::where('name', 'create-user')->first();

        // $admin = new User();
        // $admin->name = 'Admin';
        // $admin->email = 'admin@gmail.com';
        // $admin->password = bcrypt('admin');
        // $admin->save();
        // $admin->roles()->attach($admin);
        // $admin->permissions()->attach($create_post);

        // $user = new User();
        // $user->name = 'User';
        // $user->email = 'user@gmail.com';
        // $user->password = bcrypt('user');
        // $user->save();
        // $user->roles()->attach($userRole);
        // $user->permissions()->attach($create_user);
    }
}
