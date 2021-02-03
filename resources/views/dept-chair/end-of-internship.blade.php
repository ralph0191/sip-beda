@extends('layouts.app')

@section('content')
    <div class="card-header ">
        <h4 class="card-title">End of Internship Application</h4>
        <h5 class="card-category">{{Auth::user()->deptChair->course->name}}</h5>
    </div>
    <div class="content">
        <div style="float: right; margin-right: 300px;">
            <div class="dropdown">
                <h4 class="card-category"> Enter a Student Name or Student Number: </h4>
                <input type="text" class="form-control"  id="search" placeholder="search">
            </div>
        </div>   
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    <div class="card-body">          
                        <div class="table-full-width table-responsive"> 
                            <table class="table table-hover">
                                <thead style="background-color: #990f02; color: #fff;" class="text-center">
                                    <tr>
                                        <th scope="col">Student Number</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    {{-- @foreach ($students as $student)
                                        <tr>
                                            <th scope="col">{{$student->student_number}}</th>
                                            <th scope="col">{{$student->user->last_name . ' ' . $student->user->first_name}}</th>
                                            <th scope="col">
                                                <button onclick="location.href='/dept-chair/during-student-view/{{$student->id}}'" class="btn btn-primary">View Student</button>
                                            </th>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                            <div id="table-pagination"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" value="2" id="internship-type">
    <script type="text/javascript" src="{{ asset('js/custom-js/dept-chair/student-table.js') }}"> </script>  
@endsection
