<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::insert([
            [
                'name'  => 'Bachelor of Elementary Education',
            ],
            [
                'name'  => 'Bachelor of Early Childhood Education',
            ],
            [
                'name'  => 'Bachelor of Special Needs Educations',
            ],
            [
                'name'  => 'Bachelor of Secondary Education',
            ],
            [
                'name'  => 'Bachelor of Science in Business Administration',
            ],
        
            [
                'name'  => 'Bachelor of Science in Entrepreneurship',
            ],
            [
                'name'  => 'Bachelor of Science in Accountancy',
            ],
            [
                'name'  => 'Bachelor of Science in Accounting Information System',
            ],
            [
                'name'  => 'Bachelor of Science in Information Technology',
            ],
            [
                'name'  => 'Bachelor of Science in Legal Management',
            ],
            [
                'name'  => 'Bachelor of Arts in Communication and Media Studies',
            ],
            [
                'name'  => 'Bachelor of Arts in International Studies',
            ],
            [
                'name'  => 'Bachelor of Arts in Psychology',
            ],
            [
                'name'  => 'Bachelor of Science in Psychology',
            ],
        ]);
    }
}
