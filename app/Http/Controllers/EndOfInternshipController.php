<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Constants\SipStatus;
use App\Models\User;
use App\Models\Student;
use App\Models\InternshipData;
use App\Models\InternshipFiles;
use App\Models\InternshipRequirements;
use App\Models\StudentProgress;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class EndOfInternshipController extends Controller
{
    public function sipTableView()
    {
        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('end_internship_progress', SipStatus::PENDING);
        })->get();

        return view('sip.end-internship-table', compact('students'));
    }

    public function deptChairTableView()
    {
        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('pre_internship_progress', SipStatus::PENDING);
        })->get();

        return view('sip.pre-internship-table', compact('students'));
    }

    public function sipViewStudent($id)
    {
        $student = Student::find($id);
        $internshipData = InternshipData::where('student_id', $id)
        ->whereHas('internshipRequirements', function ($query) {
            $query->where('internship_type', SipStatus::END_INTERNSHIP);
        })
        ->with(['internshipRequirements' => function($query) { 
            $query->where('internship_type', SipStatus::END_INTERNSHIP);
        }])->get();

        return view('sip.end-internship-info', compact('internshipData', 'student'));
    }

    public function sipCompleteStudent($id)
    {
        $studentProgress = StudentProgress::where('student_id', $id)->first();
        $studentProgress->end_internship_progress = SipStatus::APPROVED;
        $studentProgress->update();

        return response()->json(['status' => Response::HTTP_OK]);
    }
}
