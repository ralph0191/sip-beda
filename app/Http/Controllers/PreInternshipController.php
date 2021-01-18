<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Constants\SipStatus;
use App\Models\User;
use App\Models\Student;
use App\Models\InternshipData;
use App\Models\StudentProgress;
use Symfony\Component\HttpFoundation\Response;

class PreInternshipController extends Controller
{
    public function studentView()
    {
        $internshipData = InternshipData::where('student_id', Auth::user()->student->id)->with(['internshipRequirements' => function($query) { 
            $query->where( 'internship_type', SipStatus::PRE_INTERNSHIP);
        }])->get();

        return view('students.pre-internship', compact('internshipData'));
    }

    public function sipTableView()
    {
        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('pre_internship_progress', SipStatus::PENDING);
        })->get();

        return view('sip.pre-internship-table', compact('students'));
    }

    public function sipViewStudent($id)
    {
        $student = Student::find($id);
        $internshipData = InternshipData::where('student_id', $id)->with(['internshipRequirements' => function($query) { 
            $query->where( 'internship_type', SipStatus::PRE_INTERNSHIP);
        }])->get();

        return view('sip.pre-internship-info', compact('internshipData', 'student'));
    }

    public function sipCompleteStudent($id)
    {
        $studentProgress = StudentProgress::where('student_id', $id)->first();
        $studentProgress->pre_internship_progress = SipStatus::APPROVED;
        $studentProgress->during_internship_progress = SipStatus::PENDING;
        $studentProgress->update();

        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('pre_internship_progress', SipStatus::PENDING);
        })->get();

        return view('sip.pre-internship-table', compact('students'));
    }
}
