<?php

namespace App\Http\Controllers;

use App\Constants\SipStatus;
use App\Models\InternshipData;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CompletedInternshipController extends Controller
{
    public function sipTableView(Request $request)
    {
        $courseId = $request->courseId;
        $name = $request->name;

        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('end_internship_progress', SipStatus::APPROVED_BOTH);
        })->with('user', 'course');

        if ($name != null) {
            $students->whereHas('user', function ($q) use ($name) {
                $q->where('first_name', 'LIKE', '%' . $name . '%')
                    ->orWhere('middle_name', 'LIKE', '%' . $name . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $name . '%')
                    ;
            })->orWhere('student_number' , 'LIKE', '%' . $name . '%');
        }

        if ($courseId != null) {
            $students->whereHas('course', function ($q) use ($courseId) {
                $q->where('id', $courseId);
            });
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'data'   => $students->get()
        ]);
    }

    public function deptChairTable(Request $request)
    {
        $name = $request->name;
        $courseId = Auth::user()->deptChair->course->id;

        $students = Student::whereHas('course', function ($q) use ($courseId) {
            $q->where('id', $courseId);
        })->whereHas('studentProgress', function ($q) {
            $q->where('end_internship_progress', SipStatus::APPROVED_BOTH);
        })->with('user', 'course');

        if ($name != null) {
            $students->whereHas('user', function ($q) use ($name) {
                $q->where('first_name', 'LIKE', '%' . $name . '%')
                    ->orWhere('middle_name', 'LIKE', '%' . $name . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $name . '%')
                    ;
            })->orWhere('student_number' , 'LIKE', '%' . $name . '%');
        }

        return response()->json([
            'status' => Response::HTTP_OK,
            'data'   => $students->get()
        ]);
    }

    public function sipViewStudent($id)
    {
        $student = Student::find($id);
        $internshipData = InternshipData::where('student_id', $id)
        ->with('internshipRequirements')->get();

        return view('sip.completed-internship-info', compact('internshipData', 'student'));
    }

    public function deptChairViewStudent($id)
    {
        $student = Student::find($id);
        $internshipData = InternshipData::where('student_id', $id)
        ->with('internshipRequirements')->get();

        return view('dept-chair.complete-internship-info', compact('internshipData', 'student'));
    }
}
