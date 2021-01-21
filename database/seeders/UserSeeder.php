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
                'email' => 'sip@email.com',
                'first_name' => 'sip',
                'last_name' => 'sip',
                'email'     => 'sip@email.com',
                'birthday'  =>  '1991-12-31',
                'password' => Hash::make('password'),
                'role_id' => 1
            ],
            [
                'email' => 'deptchair@email.com',
                'first_name' => 'dept',
                'last_name' => 'chair',
                'birthday'  =>  '1991-12-31',
                'password' => Hash::make('password'),
                'role_id' => 2
            ],
        ]);
    }
}
