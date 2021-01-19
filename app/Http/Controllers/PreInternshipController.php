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

        $internshipRequirements = InternshipRequirements::where('internship_type', SipStatus::PRE_INTERNSHIP)->get();
        return view('students.pre-internship', compact('internshipData', 'internshipRequirements'));
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

    public function studentDownloadFile($fileName)
    {
        return response()->download(public_path() . '/files/'. $fileName . '.docx');
    }

    public function sipDownloadFile()
    {
        
        return Storage::download('public/user_file/3/1611039569_SIP-Agreement (1).docx');
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
        $studentProgress = StudentProgress::where('student_id', $id)->first();
        $studentProgress->pre_internship_progress = SipStatus::APPROVED;
        $studentProgress->during_internship_progress = SipStatus::PENDING;
        $studentProgress->update();

        $students = Student::whereHas('studentProgress', function ($q) {
            $q->where('pre_internship_progress', SipStatus::PENDING);
        })->get();

        return view('sip.pre-internship-table', compact('students'));
    }

    public function sipApprovedFile(Request $request)
    {
        $internData = InternshipData::where('id', $request->dataId)->first();
        $internData->status = $request->status;
        $internData->remarks = $request->remarks;
        $internData->update();

        return response()->json(['status' => Response::HTTP_OK]);
    }

}
