<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\RoleEnum;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role' => RoleEnum::ADMIN->value,
        ]);

        User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@example.com',
            'role' => RoleEnum::default(),
        ]);
    }
}
