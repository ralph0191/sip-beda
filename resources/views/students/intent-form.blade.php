@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
    <div class="card-header ">
        <h5 class="card-category">Department Chair Requirements</h5>
        <h4 class="card-title">Intent Form</h4>
    </div>
    <div class="card-body">
        <p style="text-indent: 50px">
            I am providing notice of my intention to enroll in the Internship Program of the College of Arts and Science in San Beda College Alabang.
        </p>
        <p>
            Check the Details and click ok to proceed waiting for confirmation of you're pre internship
        </p>
    </div>
    <div class="form-group row">
        <label for="student_no" class="col-md-2 col-form-label text-md-right">{{ __('Student Number') }}:</label>

        <div class="col-md-4">
            <input id="student_no" type="text" class="form-control @error('student_no') is-invalid @enderror" name="student_no" value="{{ Auth::user()->student->student_number }}" disabled required autocomplete="student_no" autofocus>

            @error('student_no')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>


    <div class="form-group row">
        <label for="first_name" class="col-md-2 col-form-label text-md-right">{{ __('First Name') }}</label>

        <div class="col-md-4">
            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ Auth::user()->first_name }}" disabled autocomplete="first_name" autofocus>

            @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="middle_name" class="col-md-2 col-form-label text-md-right">{{ __('Middle Name') }}</label>

        <div class="col-md-4">
            <input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ Auth::user()->middle_name }}" disabled autocomplete="middle_name" autofocus>

            @error('middle_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="last_name" class="col-md-2 col-form-label text-md-right">{{ __('Last Name') }}</label>

        <div class="col-md-4">
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ Auth::user()->last_name }}" disabled autocomplete="last_name" autofocus>

            @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>



    <div class="form-group row">
        <label for="course" class="col-md-2 col-form-label text-md-right">{{ __('Course') }}</label>

        <div class="col-md-4">
            <input id="course" type="course" class="form-control @error('course') is-invalid @enderror" name="course" value="{{ Auth::user()->student->course->name }}" disabled>

            @error('course')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div> 

    <div class="form-group row mb-0">
        <div class="col-md-8 offset-md-4">
            <button type="submit" class="btn btn-primary" id="intent-form-btn">
                {{ __('Send Intent Form') }}
            </button>
        </div>
    </div>
    @else
    
    @endif
    
<script type="text/javascript" src="{{ asset('js/custom-js/students/intent-form.js') }}"> </script>
    
@endsection
