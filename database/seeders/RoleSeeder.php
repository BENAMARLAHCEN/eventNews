<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {

        // $admin = Role::create(['name' => 'admin']);
        // $organizer = Role::create(['name' => 'organizer']);
        // $spectator = Role::create(['name' => 'spectator']);

        $routeNames = [
            'view-events',
            'view-published-events',
            'view-rejected-events',
            'accept-event',
            'reject-event',
            'view-users',
            'edit-user-access',
            'restrict-user-access',
            'view-categories',
            'show-category',
            'create-category',
            'store-category',
            'edit-category',
            'update-category',
            'delete-category',
            'view-roles',
            'show-role',
            'create-role',
            'store-role',
            'edit-role',
            'update-role',
            'delete-role',
            'ban-user-form',
            'ban-user',
            'organizer-view-events',
            'organizer-create-event',
            'organizer-store-event',
            'organizer-edit-event',
            'organizer-update-event',
            'organizer-delete-event',
            'organizer-view-reservations',
            'organizer-view-approved-reservations',
            'organizer-view-rejected-reservations',
            'organizer-view-paid-reservations',
            'organizer-approve-reservation',
            'organizer-reject-reservation',
            'spectator-view-reservations',
            'spectator-reserve',
            'spectator-cancel-reservation',
            'spectator-payment',
            'generate-ticket'
        ];

        foreach ($routeNames as $routeName) {
            Permission::create(['name' => $routeName]);
        }
        

        Role::where('name','admin')->get()->first()->givePermissionsTo($routeNames);

        Role::where('name','organizer')->get()->first()->givePermissionsTo([
            'organizer-view-events',
            'organizer-create-event',
            'organizer-store-event',
            'organizer-edit-event',
            'organizer-update-event',
            'organizer-delete-event',
            'organizer-view-reservations',
            'organizer-view-approved-reservations',
            'organizer-view-rejected-reservations',
            'organizer-view-paid-reservations',
            'organizer-approve-reservation',
            'organizer-reject-reservation'
        ]);


        Role::where('name','spectator')->get()->first()->givePermissionsTo([
            'spectator-view-reservations',
            'spectator-reserve',
            'spectator-cancel-reservation',
            'spectator-payment',
            'generate-ticket'
        ]);


    }
}
