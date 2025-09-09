<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database with basics users.
     */
    public function run(): void
    {
        // Users with owner status

        User::factory()->create([
            'role' => 'owner',
            'firstname' => 'Kevin',
            'lastname' => 'Testher',
            'email' => 'kev.tes@test.com',
            'phone' => '0111111111',
            'birthdate' => '2002-09-04',
            'image_path' => "images/seeder-images/user-image-1.jpg",
            'password' => bcrypt('Own-19PaSS*1'),
        ]);

        User::factory()->create([
            'role' => 'owner',
            'firstname' => 'Lisa',
            'lastname' => 'Palrom',
            'email' => 'lis.pal@test.com',
            'phone' => '0111111112',
            'birthdate' => '1995-02-06',
            'image_path' => "images/seeder-images/user-image-1.jpg",
            'password' => bcrypt('Own-19PaSS*2'),
        ]);

        User::factory()->create([
            'role' => 'owner',
            'firstname' => 'Elisabeth',
            'lastname' => 'Moroen',
            'email' => 'eli.mor@test.com',
            'phone' => '0111111113',
            'birthdate' => '1986-11-03',
            'image_path' => "images/seeder-images/user-image-1.jpg",
            'password' => bcrypt('Own-19PaSS*3'),
        ]);

        User::factory()->create([
            'role' => 'owner',
            'firstname' => 'John',
            'lastname' => 'Almerford',
            'email' => 'joh.alm@test.com',
            'phone' => '0111111114',
            'birthdate' => '2003-10-11',
            'image_path' => "images/seeder-images/user-image-1.jpg",
            'password' => bcrypt('Own-19PaSS*4'),
        ]);

        User::factory()->create([
            'role' => 'owner',
            'firstname' => 'Justine',
            'lastname' => 'Arthemos',
            'email' => 'jus.art@test.com',
            'phone' => '0111111115',
            'birthdate' => '1999-2-2',
            'image_path' => "images/seeder-images/user-image-1.jpg",
            'password' => bcrypt('Own-19PaSS*5'),
        ]);

        // Users with tenant status

        User::factory()->create([
            'role' => 'tenant',
            'firstname' => 'Aline',
            'lastname' => 'Emmos',
            'email' => 'ali.emm@test.com',
            'phone' => '0222222221',
            'birthdate' => '2000-4-6',
            'image_path' => "images/seeder-images/user-image-1.jpg",
            'password' => bcrypt('Ten-19PaSS*1'),
        ]);

        User::factory()->create([
            'role' => 'tenant',
            'firstname' => 'Bernard',
            'lastname' => 'Timonier',
            'email' => 'ber.tim@test.com',
            'phone' => '0222222222',
            'birthdate' => '1976-1-3',
            'image_path' => "images/seeder-images/user-image-1.jpg",
            'password' => bcrypt('Ten-19PaSS*2'),
        ]);

        User::factory()->create([
            'role' => 'tenant',
            'firstname' => 'Nolann',
            'lastname' => 'Armadym',
            'email' => 'nol.arm@test.com',
            'phone' => '0222222223',
            'birthdate' => '1989-9-8',
            'image_path' => "images/seeder-images/user-image-1.jpg",
            'password' => bcrypt('Ten-19PaSS*3'),
        ]);

        User::factory()->create([
            'role' => 'tenant',
            'firstname' => 'Maya',
            'lastname' => 'Olbrar',
            'email' => 'may.olb@test.com',
            'phone' => '0222222224',
            'birthdate' => '2005-2-11',
            'image_path' => "images/seeder-images/user-image-1.jpg",
            'password' => bcrypt('Ten-19PaSS*4'),
        ]);

        User::factory()->create([
            'role' => 'tenant',
            'firstname' => 'Zacharie',
            'lastname' => 'Olhim',
            'email' => 'zac.olh@test.com',
            'phone' => '0222222225',
            'birthdate' => '2001-10-7',
            'image_path' => "images/seeder-images/user-image-1.jpg",
            'password' => bcrypt('Ten-19PaSS*5'),
        ]);
    }
}
