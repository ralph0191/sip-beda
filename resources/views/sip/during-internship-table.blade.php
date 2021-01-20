@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h3>During Internship Application</h5>

         {{-- <h5>{{Auth::user()->deptChair->course->name}}</h5> --}}
    </div>    
    <input type="text" id="search" placeholder="search">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Student ID</th>
            <th scope="col">Student Name</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody id="table-body">
            @foreach ($students as $student)
                <tr>
                    <th scope="col">{{$student->student_number}}</th>
                    <th scope="col">{{$student->last_name . ' ' . $student->first_name}}</th>
                    <th scope="col">
                        <button onclick="location.href='/sip/during-student-view/{{$student->id}}'" class="btn btn-primary">View Student</button>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
