<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name'=> 'test1',
            'email'=> 'test1@gmail.com',
            'password' => 'password',
            'dob' => '1992-12-12',
            'gender' => '1',
            'address' => 'Yangon',
            'phone' => '08077562345',
            'avatar_url' => '"images/VoL01QaIvDN3i9MMLYQTVfC8OqHUmk4fhJLVo88N.jpg”',
            'user_type' => 1,
            'auth_status' => 1,
        ]);
    }
}
