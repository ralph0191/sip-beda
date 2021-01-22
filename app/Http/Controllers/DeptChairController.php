<?php

namespace App\Http\Controllers;

use App\Exports\DeptChairExport;
use Illuminate\Http\Request;
use App\Models\DeptChair;
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
}
