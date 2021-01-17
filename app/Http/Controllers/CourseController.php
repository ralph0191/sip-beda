<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CourseController extends Controller
{
    public function getAllCourses() 
    {
        $courses = Course::pluck('name');
        return response()->json(['status' => Response::HTTP_OK,'course' => $courses]);
    }
}
