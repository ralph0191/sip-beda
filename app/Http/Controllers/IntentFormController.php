<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\StudentProgress;
use App\Constants\SipStatus;
use App\Models\User;
use App\Models\DeptChair;
use App\Models\InternshipData;
use App\Models\Student;
use Symfony\Component\HttpFoundation\Response;


class IntentFormController extends Controller
{
    public function approvedIntentForm() 
    {
        $studentProgress = StudentProgress::where('student_id', Auth::user()->student->id)->first();
        $studentProgress->read_form = SipStatus::PENDING;
        $studentProgress->update();

        return response()->json(['status' => Response::HTTP_OK,'course' => $studentProgress]);
    }

    public function deptChairView()
    {
        $deptChair = DeptChair::where('user_id', Auth::user()->id)->with('course')->first();

        $studentWithIntentForm = Student::whereHas('studentProgress', function($q){
            $q->where('read_form', SipStatus::PENDING);
        })->where('course_id', $deptChair->course_id)->get();

        
        return view('dept-chair.intent-forms', compact('studentWithIntentForm', 'deptChair'));
    }

    public function deptChairApproved($id)
    {
        $studentProgress = StudentProgress::where('student_id', $id)->first();
        $studentProgress->read_form = SipStatus::APPROVED;
        $studentProgress->pre_internship_progress = SipStatus::PENDING;
        $studentProgress->update();
        
        for ($i = 1; $i < 18; $i++) {
            if ($i == 1) {
                InternshipData::insert([
                    [
                        'student_id' => $id,
                        'internship_requirements_id' => $i,
                        'file_url' => '',
                        'remarks'   => '',
                        'status'    => SipStatus::APPROVED
                    ],
                ]);
            } else {
                InternshipData::insert([
                    [
                        'student_id' => $id,
                        'internship_requirements_id' => $i,
                        'file_url' => '',
                        'remarks'   => '',
                        'status'    => SipStatus::NOT_STARTED
                    ],
                ]);
            }
           
        }
        
        return response()->json(['status' => Response::HTTP_OK]);
    }
}
