@extends('layouts.app')

@section('content')
    <div class="card-header ">
        <h4 class="card-title">End of Internship Application</h4>
        <h5 class="card-category">{{Auth::user()->deptChair->course->name}}</h5>
    </div>  
    <div class="content">
        <div class="row">
            <div class="col-md-9">
                <div class="card-header">
                    <div class="card-body">          
                        <div class="table-full-width table-responsive"> 
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
                                                <button onclick="location.href='/dept-chair/end-student-view/{{$student->id}}'" class="btn btn-primary">View Student</button>
                                            </th>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection
