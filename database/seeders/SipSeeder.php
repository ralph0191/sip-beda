<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            'id' => '1',
            'role_name' => 'superadmin'
        ]);
    }
}
