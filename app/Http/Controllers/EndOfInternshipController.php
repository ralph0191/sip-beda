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

    public function deptChairTable()
    {
        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('end_internship_progress', SipStatus::PENDING);
        })->get();

        return view('dept-chair.end-of-internship', compact('students'));
    }

    public function deptChairViewStudent($id)
    {
        $student = Student::find($id);
        $internshipData = InternshipData::where('student_id', $id)
        ->whereHas('internshipRequirements', function ($query) {
            $query->where('internship_type', SipStatus::END_INTERNSHIP);
        })
        ->with(['internshipRequirements' => function($query) { 
            $query->where('internship_type', SipStatus::END_INTERNSHIP);
        }])->get();

        return view('dept-chair.end-of-internship-info', compact('internshipData', 'student'));
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
    
    public function deptChairCompleteStudent($id)
    {
        $studentProgress = StudentProgress::where('student_id', $id)->first();
        $studentProgress->end_internship_progress = SipStatus::APPROVED;
        $studentProgress->update();

        return response()->json(['status' => Response::HTTP_OK]);
    }

    public function sipCompleteStudent($id)
    {
        $studentProgress = StudentProgress::where('student_id', $id)->first();
        $studentProgress->end_internship_progress = SipStatus::APPROVED_BOTH;
        $studentProgress->update();

        return response()->json(['status' => Response::HTTP_OK]);
    }

    public function studentView()
    {
        $internshipData = InternshipData::where('student_id', Auth::user()->student->id)
        ->whereHas('internshipRequirements', function ($query) {
            $query->where('internship_type', SipStatus::END_INTERNSHIP);
        })
        ->with(['internshipRequirements' => function($query) { 
            $query->where('internship_type', SipStatus::END_INTERNSHIP);
        }])->get();

        return view('students.end-internship', compact('internshipData'));
    }

    public function studentUploadFile(Request $request)
    {
        $internshipRequirement = json_decode($request->fileTreeObj);
        $requirementId = (int) $internshipRequirement->internshipRequirementsId;

        if ($request->hasFile('file')) {
            $student = Student::where('user_id', Auth::user()->id)->first();
            $internshipData = InternshipData::where([
                ['student_id', '=', $student->id],
                ['internship_requirements_id', '=', $requirementId]
            ])->first();

            if (count($internshipData->internshipFiles) > 0) {
                
                if ($internshipData->internship_requirements_id != SipStatus::DURING_WEEKLY) {
                    foreach ($internshipData->internshipFiles as $file) {
                        Storage::delete($file->file_url);
                        $file->delete();
                    }
                } 
            }

            foreach($request->file('file') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('public/user_file/' . $requirementId . '/' . Auth::user()->id, $fileName);

                InternshipFiles::create([
                    'internship_data_id' => $internshipData->id,
                    'file_name' => $file->getClientOriginalName(),
                    'file_url'  => $path
                ]);

                // $internshipData->file_url = $path;
                $internshipData->status = SipStatus::PENDING;
                $internshipData->update();
            }
        }

        return response()->json(['status' => Response::HTTP_OK]);
    }

    public function deptChairCheckFile(Request $request)
    {
        $internData = InternshipData::where('id', $request->dataId)->first();
        $internData->status = $request->status;
        $internData->remarks = $request->remarks;
        $internData->update();

        return response()->json(['status' => Response::HTTP_OK]);
    }

}
