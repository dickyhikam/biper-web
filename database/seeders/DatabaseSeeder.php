<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@biper.id',
            'password' => 'password',
            'role' => User::ROLE_SUPER_ADMIN,
        ]);

        User::factory()->create([
            'name' => 'Owner Biper',
            'email' => 'owner@biper.id',
            'password' => 'password',
            'role' => User::ROLE_OWNER,
        ]);

        User::factory()->create([
            'name' => 'Admin Biper',
            'email' => 'admin@biper.id',
            'password' => 'password',
            'role' => User::ROLE_ADMIN,
        ]);

        User::factory()->create([
            'name' => 'Bd. Sri Rahayu',
            'email' => 'bidan@biper.id',
            'password' => 'password',
            'role' => User::ROLE_BIDAN_TERAPIS,
        ]);
    }
}
