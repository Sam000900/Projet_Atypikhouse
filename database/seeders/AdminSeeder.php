<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Seed the application's database with the admins users.
     */
    public function run(): void
    {
        User::factory()->create([
            'role' => 'admin',
            'firstname' => 'Samantha',
            'lastname' => 'Garguier',
            'email' => 'sam.gar@test.com',
            'phone' => '0123456789',
            'birthdate' => '2000-01-01',
            'password' => bcrypt('Sam!+Gar84'),
        ]);
    }
}