@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
        <div class="card-header ">
            <h4 class="card-title">Pre-Interns</h4>
        </div>
        <div class="content">
            <div class="content">
                <div style="float: right; margin-right: 300px;">
                    <div class="dropdown">
                        <h4 class="card-category"> Course Filter by: </h4>
                        <select class="form-control" id="course" required>
                            <option value="" selected> Choose an option</option>
                        </select>
                    </div>
                    <div class="dropdown">
                        <h4 class="card-category"> Enter a Student Name or Number: </h4>
                        <input type="text" class="form-control" id="search" placeholder="search">
                    </div>
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
                                    <thead class="thead-dark">
                                        <tr class="text-center">
                                            <th scope="col">Student Number</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">View</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        {{-- @foreach ($students as $student)
                                        <tr>
                                            <td>{{$student->student_number}}</td>
                                            <td>{{$student->user->last_name . ' ' . $student->user->first_name}}</td>
                                            <td>{{$student->course->name}}</td>
                                            <td><button onclick="location.href='/sip/pre-student-view/{{$student->id}}'" class="btn btn-primary">View Student</button></td>
                                        </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                                <div id="pre-intern-pagination"></div>
                            </div>
                        </div>   
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" id="internship-type" value="0">
        <script type="text/javascript" src="{{ asset('js/custom-js/sip/during-internship-table.js') }}"> </script>
        <input type="hidden" value="0" id="internship-type">
    @else
    
    @endif

    
@endsection
