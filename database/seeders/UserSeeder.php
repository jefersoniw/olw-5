<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'role_id' => 1,
            'name' => 'Admin User',
            'email' => 'admin@teste.com'
        ]);

        User::factory()->create([
            'role_id' => 2,
            'name' => 'Customer 1 User',
            'email' => 'admin@teste.com'
        ]);
        User::factory()->create([
            'role_id' => 2,
            'name' => 'Customer 2 User',
            'email' => 'admin@teste.com'
        ]);
        User::factory()->create([
            'role_id' => 2,
            'name' => 'Customer 3 User',
            'email' => 'admin@teste.com'
        ]);
    }
}
