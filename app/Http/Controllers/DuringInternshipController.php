<?php

namespace App\Http\Controllers;

use App\Constants\SipStatus;
use App\Models\Student;
use Illuminate\Http\Request;

class DuringInternshipController extends Controller
{
    public function sipTableView()
    {
        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('during_internship_progress', SipStatus::APPROVED);
        })->get();

        return view('sip.pre-internship-table', compact('students'));
    }

    public function deptChairTableView()
    {
        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('during_internship_progress', SipStatus::PENDING);
        })->get();

        return view('sip.pre-internship-table', compact('students'));
    }

}
