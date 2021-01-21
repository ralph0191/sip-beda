<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sip;

class SipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Sip::insert([
            'user_id' => 1,
            'employee_number' => '00000000'
        ]);
    }
}
