<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CoursesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SipSeeder::class);
        $this->call(DeptChairSeeder::class);
        $this->call(InternshipRequirementsSeeder::class);
    }
}
