@extends('layouts.app')

@section('content')
    <div class="card-header ">
        <h4 class="card-title">During Internship Application</h4>
    </div> 
    <div class="content">
        <div style="float: right; margin-right: 300px;">
            <div class="dropdown">
                <button onclick="location.href='/sip/during-student-view/'" class="btn btn-success">Create Dept Chair</button>
            </div>
            <div class="dropdown">
                <h4 class="card-category"> Course Filter by: </h4>
                <select class="form-control" id="course" required>
                    <option disabled selected> Choose an option</option>
                </select>
            </div>
            <div class="dropdown">
                <h4 class="card-category"> Enter a Student Name: </h4>
                <input type="text" class="form-control" id="search" placeholder="search">
            </div>
        </div>   
    </div>
    <div class="content">
            <div class="row">
                <div class="col-md-10">
                    <div class="card-header">
                        <div class="card-body">          
                            <div class="table-full-width table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Employee Number</th>
                                        <th scope="col">Dept Chair Name</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        @foreach ($deptChairs as $deptChair)
                                            <tr>
                                                <td scope="col">{{$deptChair->employee_number}}</td>
                                                <td scope="col">{{$deptChair->user->last_name . ' ' . $deptChair->user->first_name}}</td>
                                                <td>{{$deptChair->course->name}}</td>
                                                <td scope="col"><button onclick="location.href='/sip/during-student-view/{{$deptChair->id}}'" class="btn btn-primary">View Student</button></td>
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
    </div>   
@endsection
