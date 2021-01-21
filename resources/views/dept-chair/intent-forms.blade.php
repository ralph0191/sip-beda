@extends('layouts.app')

@section('content')
    <div class="card-header ">
        <h4 class="card-title">Intent Forms Application</h4>
        <h5 class="card-category">{{$deptChair->course->name}}</h5>
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
                                    <th scope="col">Student ID</th>
                                    <th scope="col">Student Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($studentWithIntentForm as $student)
                                        <tr>
                                            <th scope="col">{{$student->student_number}}</th>
                                            <th scope="col">{{$student->user->last_name . ' ' . $student->user->first_name}}</th>
                                            <th scope="col">
                                                <button class="btn btn-primary" id="accept-btn" data-id="{{$student->id}}">Accept Intent Form</button>
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
    
    <script type="text/javascript" src="{{ asset('js/custom-js/dept-chair/intent-form.js') }}"> </script>
    
@endsection
