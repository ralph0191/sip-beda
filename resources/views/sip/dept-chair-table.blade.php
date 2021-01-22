@extends('layouts.app')

@section('content')
    <div class="card-header ">
        <h4 class="card-title">During Internship Application</h4>
    </div> 
    <div class="content">
        <div style="float: right; margin-right: 300px;">
            <div class="dropdown">
                <button onclick="location.href='/sip/dept-chairs/batch/template'" class="btn btn-success">Mass upload Template</button>
            </div>
            <div class="dropdown">
                <h4 class="card-category"> Add File </h4>
                <input type="file" id="file" class="form-control-file">
            </div>
            <div class="dropdown">
                <button id="upload" class="btn btn-primary">Mass upload Launch</button>
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
                                    <tr class="text-center">
                                        <th scope="col">Employee Number</th>
                                        <th scope="col">Dept Chair Name</th>
                                        <th scope="col">Course</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-body">
                                        {{-- @foreach ($deptChairs as $deptChair)
                                            <tr>
                                                <td scope="col">{{$deptChair->employee_number}}</td>
                                                <td scope="col">{{$deptChair->user->last_name . ' ' . $deptChair->user->first_name}}</td>
                                                <td>{{$deptChair->course->name}}</td>
                                                <td scope="col"><button onclick="location.href='/sip/during-student-view/{{$deptChair->id}}'" class="btn btn-primary">View Student</button></td>
                                            </tr>
                                        @endforeach --}}
                                    </tbody>
                                </table>
                                <div id="dept-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   
    <input type="hidden" id="offset">
    <input type="hidden" id="current-max">
    <script type="text/javascript" src="{{ asset('js/custom-js/sip/dept-chair.js') }}"> </script>
@endsection
