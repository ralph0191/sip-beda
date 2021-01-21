<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeptChair;

class DeptChairController extends Controller
{
    public function deptChairs() {
        $deptChairs = DeptChair::all();
        
        return view('sip.dept-chair-table', compact('deptChairs'));
    }
}
