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

class PreInternshipController extends Controller
{
    public function studentView()
    {
        $internshipData = InternshipData::where('student_id', Auth::user()->student->id)->whereHas('internshipRequirements', function ($query) {
            $query->where('internship_type', SipStatus::PRE_INTERNSHIP);
        })->with(['internshipRequirements' => function($query) { 
            $query->where('internship_type', SipStatus::PRE_INTERNSHIP);
        }])->get();
        return view('students.pre-internship', compact('internshipData'));
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
                foreach ($internshipData->internshipFiles as $file) {
                    Storage::delete($file->file_url);
                    $file->delete();
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
                
                $internshipData->status = SipStatus::PENDING;
                $internshipData->update();
            }
        }

        return response()->json(['status' => Response::HTTP_OK]);
    }

    public function studentDownloadFile($fileName)
    {
        return response()->download(public_path() . '/files/'. $fileName . '.docx');
    }

    public function sipDownloadFile($id)
    {
        $internshipFile = InternshipFiles::find($id);

        return Storage::download($internshipFile->file_url);
    }

    public function sipTableView(Request $request)
    {
        $courseId = $request->courseId;
        $name = $request->name;

        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('pre_internship_progress', SipStatus::PENDING);
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

    public function sipViewStudent($id)
    {
        $student = Student::find($id);
        $internshipData = InternshipData::where('student_id', $id)
        ->whereHas('internshipRequirements', function ($query) {
            $query->where('internship_type', SipStatus::PRE_INTERNSHIP);
        })
        ->with(['internshipRequirements' => function($query) { 
            $query->where('internship_type', SipStatus::PRE_INTERNSHIP);
        }])->get();
        // $internshipData = InternshipData::where('student_id', $id)->get();

        return view('sip.pre-internship-info', compact('internshipData', 'student'));
    }

    public function sipCompleteStudent($id)
    {
        $studentRequirements = InternshipData::whereIn('internship_requirements_id' ,SipStatus::PRE_INTERNSHIP_ARRAY)
        ->where([
            ['student_id', '=', $id],
            ['status', '=', SipStatus::APPROVED]
        ])->count();

        if ($studentRequirements == SipStatus::PRE_INTERNSHIP_REQUIREMENTS) {
            $studentProgress = StudentProgress::where('student_id', $id)->first();
            $studentProgress->pre_internship_progress = SipStatus::APPROVED;
            $studentProgress->during_internship_progress = SipStatus::PENDING;
            $studentProgress->update();

            $students = Student::whereHas('studentProgress', function ($q) {
                $q->where('pre_internship_progress', SipStatus::PENDING);
            })->get();

            return response()->json(['status' => Response::HTTP_OK]);
        } else {
            return response()->json(['status' => Response::HTTP_NOT_ACCEPTABLE]);
        }
        
    }

    public function sipActionFile(Request $request)
    {
        $internData = InternshipData::where('id', $request->dataId)->first();
        $internData->status = $request->status;

        if ((int) $internData->status == SipStatus::DISAPPROVED) {

            if (count($internData->internshipFiles) > 0) {
                foreach ($internData->internshipFiles as $file) {
                    Storage::delete($file->file_url);
                    $file->delete();
                }
            }
        }

        $internData->remarks = $request->remarks;
        $internData->update();

        return response()->json(['status' => Response::HTTP_OK]);
    }

}
