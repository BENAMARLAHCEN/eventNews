<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RoleSeeder::class);
        // \App\Models\User::factory(20)->create();
        
        // $this->call(CategorySeeder::class);

        // User::get()->each(function ($user) {
        //     $role = Role::inRandomOrder()->first();
        //     $user->assignRole($role->name);
        // });

        // $this->call(EventSeeder::class);

        // $this->call(ReservationSeeder::class);
     
        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $user = User::create([
        //     'name' => 'Test admin',
        //     'email' => 'admin@admin.com',
        //     'password' => 'password',
        // ]);

        // $user->assignRole('admin');

    }
}
