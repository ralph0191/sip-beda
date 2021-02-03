<?php

namespace App\Http\Controllers;

use Auth;
use App\Constants\SipStatus;
use App\Models\Student;
use App\Models\DeptChair;
use App\Models\InternshipData;
use App\Models\InternshipFiles;

use App\Models\StudentProgress;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use Symfony\Component\HttpFoundation\Response;

class DuringInternshipController extends Controller
{
    public function sipTableView(Request $request)
    {
        $courseId = $request->courseId;
        $name = $request->name;

        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('during_internship_progress', SipStatus::APPROVED);
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
            $q->where('during_internship_progress', SipStatus::PENDING);
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

    public function deptChairTableView($id)
    {
        $student = Student::find($id);
        $internshipData = InternshipData::where('student_id', $id)
        ->whereHas('internshipRequirements', function ($query) {
            $query->where('internship_type', SipStatus::DURING_INTERNSHIP);
        })
        ->with(['internshipRequirements' => function($query) { 
            $query->where('internship_type', SipStatus::DURING_INTERNSHIP);
        }])->get();

        return view('dept-chair.during-internship-info', compact('internshipData', 'student'));
    }

    public function sipViewStudent($id)
    {
        $student = Student::find($id);
        $internshipData = InternshipData::where('student_id', $id)
        ->whereHas('internshipRequirements', function ($query) {
            $query->where('internship_type', SipStatus::DURING_INTERNSHIP);
        })
        ->with(['internshipRequirements' => function($query) { 
            $query->where('internship_type', SipStatus::DURING_INTERNSHIP);
        }])->get();

        return view('sip.during-internship-info', compact('internshipData', 'student'));
    }

    public function studentView()
    {
        $internshipData = InternshipData::where('student_id', Auth::user()->student->id)
        ->whereHas('internshipRequirements', function ($query) {
            $query->where('internship_type', SipStatus::DURING_INTERNSHIP);
        })
        ->with(['internshipRequirements' => function($query) { 
            $query->where('internship_type', SipStatus::DURING_INTERNSHIP);
        }])->get();

        return view('students.during-internship', compact('internshipData'));
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

    public function deptChairCompleteStudent($id)
    {
        $studentRequirements = InternshipData::whereIn('id' ,SipStatus::DURING_INTERNSHIP_ARRAY)
        ->where('student_id', $id)->where('status', SipStatus::APPROVED)->count();
        
        if ($studentRequirements == SipStatus::DURING_INTERNSHIP_REQUIREMENTS) {
            $studentProgress = StudentProgress::where('student_id', $id)->first();
            $studentProgress->during_internship_progress = SipStatus::APPROVED;
            $studentProgress->update();

            return response()->json(['status' => Response::HTTP_OK]);
        }  else {
            return response()->json(['status' => Response::HTTP_NOT_ACCEPTABLE]);
        }
        
    }

    public function sipCompleteStudent($id)
    {
        $studentProgress = StudentProgress::where('student_id', $id)->first();
        $studentProgress->during_internship_progress = SipStatus::APPROVED_BOTH;
        $studentProgress->end_internship_progress = SipStatus::PENDING;
        $studentProgress->update();

        return response()->json(['status' => Response::HTTP_OK]);
    }
}
