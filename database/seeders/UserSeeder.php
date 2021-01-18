<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name' => 'sip',
                'email' => 'sip@email.com',
                'password' => Hash::make('password'),
                'role_id' => 1
            ],
            [
                'name' => 'deptchair',
                'email' => 'deptchair@email.com',
                'password' => Hash::make('password'),
                'role_id' => 2
            ],
        ]);
    }
}
