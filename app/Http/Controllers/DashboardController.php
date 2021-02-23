<?php

namespace App\Http\Controllers;

use App\Constants\SipStatus;
use App\Models\InternshipData;
use App\Models\StudentProgress;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //students
    public function getPreInternshipData()
    {   
        $data = InternshipData::where([
            ['student_id', '=', Auth::user()->student->id]
            // []
        ])
            ->whereIn('internship_requirements_id', SipStatus::PRE_INTERNSHIP_ARRAY)
            ->addSelect(DB::raw('SUM(CASE WHEN status = 0 THEN 1 ELSE 0 end OR CASE WHEN status = 1 THEN 1 ELSE 0 END) AS not_completed'))
            ->addSelect(DB::raw('SUM(CASE WHEN status = 2 THEN 1 ELSE 0 end) AS completed '))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function getDuringInternshipData()
    {   
        $data = InternshipData::where([
            ['student_id', '=', Auth::user()->student->id]
            // []
        ])
            ->whereIn('internship_requirements_id', SipStatus::DURING_INTERNSHIP_ARRAY)
            ->addSelect(DB::raw('SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END OR CASE WHEN status = 1 THEN 1 ELSE 0 end OR CASE WHEN status = 2 THEN 1 ELSE 0 END) AS not_completed'))
            ->addSelect(DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS completed '))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function getEndInternshipData()
    {   
        $data = InternshipData::where([
            ['student_id', '=', Auth::user()->student->id]
            // []
        ])
            ->whereIn('internship_requirements_id', SipStatus::END_INTERNSHIP_ARRAY)
            ->addSelect(DB::raw('SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END OR case when status = 1 then 1 ELSE 0 END OR CASE WHEN status = 2 THEN 1 ELSE 0 END) AS not_completed'))
            ->addSelect(DB::raw('SUM(CASE WHEN status = 3 THEN 1 ELSE 0 END) AS completed '))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function deptChairIntentForms()
    {   
        $data = StudentProgress::whereHas('student', function ($query) {
            $query->where('course_id', Auth::user()->deptChair->course_id);
        })->addSelect(DB::raw('SUM(CASE WHEN read_form = 0 THEN 1 ELSE 0 END) AS not_submitted'))
        ->addSelect(DB::raw('SUM(CASE WHEN read_form = 1 THEN 1 ELSE 0 END) AS pending'))
        ->addSelect(DB::raw('SUM(CASE WHEN read_form = 2 THEN 1 ELSE 0 END) AS approved'))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function deptChairDuringInternship()
    {   
        $data = StudentProgress::whereHas('student', function ($query) {
            $query->where('course_id', Auth::user()->deptChair->course_id);
        })->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 0 THEN 1 ELSE 0 END) AS not_started'))
        ->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 1 THEN 1 ELSE 0 END OR CASE WHEN during_internship_progress = 2 THEN 1 ELSE 0 END) AS started'))
        ->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 3 THEN 1 ELSE 0 END) AS finished'))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function deptChairEndInternship()
    {   
        $data = StudentProgress::whereHas('student', function ($query) {
            $query->where('course_id', Auth::user()->deptChair->course_id);
        })->addSelect(DB::raw('SUM(CASE WHEN end_internship_progress = 0 THEN 1 ELSE 0 END) AS not_started'))
        ->addSelect(DB::raw('SUM(CASE WHEN end_internship_progress = 1 THEN 1 ELSE 0 END OR CASE WHEN end_internship_progress = 2 THEN 1 ELSE 0 END) AS started'))
        ->addSelect(DB::raw('SUM(CASE WHEN end_internship_progress = 3 THEN 1 ELSE 0 END) AS finished'))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function getAllSipPreInternshipData()
    {   
        $data = StudentProgress ::addSelect(DB::raw('SUM(CASE WHEN pre_internship_progress = 0 THEN 1 ELSE 0 END) AS not_started'))
        ->addSelect(DB::raw('SUM(CASE WHEN pre_internship_progress = 1 THEN 1 ELSE 0 END) AS ongoing'))
        ->addSelect(DB::raw('SUM(CASE WHEN pre_internship_progress = 2 THEN 1 ELSE 0 END) AS finished'))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function getAllSipDuringInternshipData()
    {   
        $data = StudentProgress::addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 0 THEN 1 ELSE 0 END) AS not_started'))
        ->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 1 THEN 1 ELSE 0 END OR CASE WHEN during_internship_progress = 2 THEN 1 ELSE 0 END) AS ongoing'))
        ->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 3 THEN 1 ELSE 0 END) AS finished'))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function getAllSipEndInternshipData()
    {   
        $data = StudentProgress::addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 0 THEN 1 ELSE 0 END) AS not_started'))
        ->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 1 THEN 1 ELSE 0 END OR CASE WHEN during_internship_progress = 2 THEN 1 ELSE 0 END) AS ongoing'))
        ->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 3 THEN 1 ELSE 0 END) AS finished'))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function getFilteredSipPreInternshipData($courseId)
    {   
        $data = StudentProgress::whereHas('student', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->addSelect(DB::raw('SUM(CASE WHEN pre_internship_progress = 0 THEN 1 ELSE 0 END) AS not_started'))
        ->addSelect(DB::raw('SUM(CASE WHEN pre_internship_progress = 1 THEN 1 ELSE 0 END) AS ongoing'))
        ->addSelect(DB::raw('SUM(CASE WHEN pre_internship_progress = 2 THEN 1 ELSE 0 END) AS finished'))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function getFilteredSipDuringInternshipData($courseId)
    {   
        $data = StudentProgress::whereHas('student', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 0 THEN 1 ELSE 0 END) AS not_started'))
        ->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 1 THEN 1 ELSE 0 END OR CASE WHEN during_internship_progress = 2 THEN 1 ELSE 0 END) AS ongoing'))
        ->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 3 THEN 1 ELSE 0 END) AS finished'))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }

    public function getFilteredSipEndInternshipData($courseId)
    {   
        $data = StudentProgress::whereHas('student', function ($query) use ($courseId) {
            $query->where('course_id', $courseId);
        })->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 0 THEN 1 ELSE 0 END) AS not_started'))
        ->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 1 THEN 1 ELSE 0 END OR CASE WHEN during_internship_progress = 2 THEN 1 ELSE 0 END) AS ongoing'))
        ->addSelect(DB::raw('SUM(CASE WHEN during_internship_progress = 3 THEN 1 ELSE 0 END) AS finished'))->get();

        return response()->json(['status'=> Response::HTTP_OK,
            'data' => $data
        ]);
    }
}
