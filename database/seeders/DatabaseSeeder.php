<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
            RolesSeeder::class
        ]);

        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456')
        ]);
        $admin->assignRole('admin');
        $user = \App\Models\User::factory()->create([
            'name' => 'B2C',
            'email' => 'b2b@b2b.com',
            'password' => Hash::make('123456')
        ]);
        $user->assignRole('customer');
        $user = \App\Models\User::factory()->create([
            'name' => 'B2B',
            'email' => 'b2c@b2c.com',
            'password' => Hash::make('123456')
        ]);
        $user->assignRole('customer');
    }
}
