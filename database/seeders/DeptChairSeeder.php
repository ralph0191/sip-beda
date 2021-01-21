<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DeptChair;

class DeptChairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DeptChair::insert([
            'user_id' => 2,
            'employee_number' => '00000001',
            'course_id'        => 9
        ]);
    }
}
