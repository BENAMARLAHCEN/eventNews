<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {

        $admin = Role::create(['name' => 'admin']);
        $organizer = Role::create(['name' => 'organizer']);
        $spectator = Role::create(['name' => 'spectator']);

        Permission::create(['name' => 'create-event']);
        Permission::create(['name' => 'update-event']);
        Permission::create(['name' => 'delete-event']);
        Permission::create(['name' => 'view-event']);
        Permission::create(['name' => 'view-any-event']);
        Permission::create(['name' => 'create-category']);
        Permission::create(['name' => 'update-category']);
        Permission::create(['name' => 'delete-category']);
        Permission::create(['name' => 'view-category']);
        Permission::create(['name' => 'view-any-category']);
        Permission::create(['name' => 'create-reservation']);
        Permission::create(['name' => 'update-reservation']);
        Permission::create(['name' => 'delete-reservation']);
        Permission::create(['name' => 'view-reservation']);
        Permission::create(['name' => 'view-any-reservation']);
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'update-user']);
        Permission::create(['name' => 'delete-user']);
        Permission::create(['name' => 'view-user']);
        Permission::create(['name' => 'view-any-user']);
        Permission::create(['name' => 'create-role']);
        Permission::create(['name' => 'update-role']);
        Permission::create(['name' => 'delete-role']);
        Permission::create(['name' => 'view-role']);
        Permission::create(['name' => 'view-any-role']);
        Permission::create(['name' => 'create-permission']);
        Permission::create(['name' => 'update-permission']);
        Permission::create(['name' => 'delete-permission']);
        Permission::create(['name' => 'view-permission']);
        Permission::create(['name' => 'view-any-permission']);
        Permission::create(['name' => 'access-dashboard']);
        Permission::create(['name' => 'access-profile']);
        Permission::create(['name' => 'access-settings']);
        Permission::create(['name' => 'access-roles']);
        Permission::create(['name' => 'access-permissions']);
        Permission::create(['name' => 'access-users']);
        Permission::create(['name' => 'access-events']);
        Permission::create(['name' => 'access-reservations']);
        Permission::create(['name' => 'access-categories']);
        Permission::create(['name' => 'access-statistics']);
        Permission::create(['name' => 'edit-profile']);
        Permission::create(['name' => 'restrict-access']);
        Permission::create(['name' => 'accept-event']);
        Permission::create(['name' => 'reject-event']);
        Permission::create(['name' => 'publish-event']);
        Permission::create(['name' => 'unpublish-event']);
        Permission::create(['name' => 'view-published-events']);
        Permission::create(['name' => 'view-rejected-events']);
        Permission::create(['name' => 'view-all-events']);
        Permission::create(['name' => 'view-all-reservations']);
        Permission::create(['name' => 'view-all-users']);
        Permission::create(['name' => 'view-all-categories']);
  



        // $admin->givePermissionsTo([
        //     'create-event',
        //     'update-event',
        //     'delete-event',
        //     'view-event',
        //     'view-any-event',
        //     'create-category',
        //     'update-category',
        //     'delete-category',
        //     'view-category',
        //     'view-any-category',
        //     'create-reservation',
        //     'update-reservation',
        //     'delete-reservation',
        //     'view-reservation',
        //     'view-any-reservation',
        //     'create-user',
        //     'update-user',
        //     'delete-user',
        //     'view-user',
        //     'view-any-user',
        //     'create-role'
        // ]);

        // $organizer->givePermissionsTo([
        //     'create-event',
        //     'update-event',
        //     'delete-event',
        //     'view-event',
        //     'view-any-event',
        //     'view-any-category',
        //     'create-reservation',
        //     'update-reservation',
        //     'delete-reservation',
        //     'view-reservation',
        //     'edit-profile'
        
        // ]);


    }
}
