<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Students;

class PreInternshipController extends Controller
{
    public function studentView()
    {
        return view('students.pre-internship');
    }
}
