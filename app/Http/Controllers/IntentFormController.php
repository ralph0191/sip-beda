<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Models\StudentProgress;
use App\Constants\SipStatus;
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
}
