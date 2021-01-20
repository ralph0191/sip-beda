@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <h3>End of Internship Application</h5>
        <h5>{{$deptChair->course->name}}</h5>
    </div>    

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
                    <th scope="col">{{$student->last_name . ' ' . $student->first_name}}</th>
                    <td ><button onclick="location.href='/dept-chair/during-student-view/{{$student->id}}'" class="btn btn-primary">View Student</button></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <script type="text/javascript" src="{{ asset('js/custom-js/dept-chair/intent-form.js') }}"> </script>
    
@endsection
