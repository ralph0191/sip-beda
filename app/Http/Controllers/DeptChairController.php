<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\DeptChairExport;
use App\Imports\DeptChairImport;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use DB;
use App\Models\DeptChair;
use Maatwebsite\Excel\Validators\ValidationException;
use Maatwebsite\Excel\Facades\Excel;

class DeptChairController extends Controller
{
    public function deptChairs() {
        $deptChairs = DeptChair::get();
        
        return view('sip.dept-chair-table', compact('deptChairs'));
    }

    public function sample()
    {
        return Excel::download(new DeptChairExport(), 'dept-chair-template.xlsx');
    }

    public function deptChairPaginate()
    {
        $users = User::has('deptChair')->with('deptChair', 'deptChair.course')->get();

        return response()->json([
            'status' => Response::HTTP_OK,
            'data' =>   $users
        ]);
    }

    public function import(Request $request)
    {

        try {
            if(is_null($request->file('file'))) {
                return response()->json(['success'=>Response::HTTP_NOT_ACCEPTABLE, 'msg' => 'file is empty']);
            }

            $spreadsheet = $request->file('file');
            $extension       = $spreadsheet->getClientOriginalExtension();
            $allowed         = ['csv','xlsx','xls'];

            if (in_array($extension, $allowed) === FALSE) {
                return response()->json(['status'=>Response::HTTP_NOT_ACCEPTABLE,
                    'msg' => 'File is not in ' . implode(',', $allowed) . ' format']);
            }
            DB::beginTransaction();

            $import = new DeptChairImport;
            $import->import($spreadsheet);
            
            DB::commit();
            
            $users = User::has('deptChair')->with('deptChair', 'deptChair.course')->get();
            
            return response()->json([
                'status' => Response::HTTP_OK,
                'data' =>   $users
            ]);
        } catch (ValidationException $e) {
            $failure = $e->failures()[0];
            DB::rollback();
            $err = 'Error on row: '. $failure->row() . ', attribute: '. $failure->attribute() .', '. $failure->errors()[0];
            return response()->json(['status'=>Response::HTTP_CONFLICT,
                'msg' => 'Could not import Dept Chairs, '. $err]);
        }
        
    }
}
