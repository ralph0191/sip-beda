@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
        <br/>
        <h4>Pre-Interns</h4>
        <table class="table table-bordered" >
            <thead>
            <tr>
                <th scope="col">Student Number</th>
                <th scope="col">Student Name</th>
                <th scope="col">Course</th>
                <th scope="col">View</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td>{{$student->student_number}}</td>
                    <td>{{$student->last_name . ' ' . $student->first_name}}</td>
                    <td>{{$student->course->name}}</td>
                    <td ><button onclick="location.href='/sip/pre-student-view/{{$student->id}}'" class="btn btn-primary">View Student</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
    
    @endif

@endsection
