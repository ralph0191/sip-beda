@extends('layouts.app')

@section('content')
    <div class="card-header ">
        <h4 class="card-title">Post Internship Application</h4>
    </div> 
    <div class="content">
        <div style="float: right; margin-right: 300px;">
            <div class="dropdown">
                <h4 class="card-category"> Course Filter by: </h4>
                <select class="form-control" id="course" required>
                    <option disabled selected> Choose an option</option>
                </select>
            </div>
            <div class="dropdown">
                <h4 class="card-category"> Enter a Student Name or Student Number: </h4>
                <input type="text" class="form-control" id="search" placeholder="search">
            </div>
        </div>   
    </div>

    <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-header">
                        <div class="card-body">          
                            <div class="table-full-width table-responsive">
                                <table class="table table-hover text-center ">
                                    <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Student ID</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Course</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        {{-- @foreach ($students as $student)
                                            <tr>
                                                <td scope="col">{{$student->student_number}}</td>
                                                <td scope="col">{{$student->user->last_name . ' ' . $student->user->first_name}}</td>
                                                <td scope="col">
                                                    <button onclick="location.href='/sip/end-student-view/{{$student->id}}'" class="btn btn-primary">View Student</button>
                                                </td>
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
    </div>
    <input type="hidden" value="2" id="internship-type">
    <script type="text/javascript" src="{{ asset('js/custom-js/sip/during-internship-table.js') }}"> </script>
@endsection
