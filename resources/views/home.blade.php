@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
        <div class="container-fluid">
            <h1 class="mt-4">Dashboard</h1>
            <div class="col-md-12">
                @if (Auth::user()->student)
                    <div class="row">
                        <div class="col-md-4">
                            <label>Pre-internship Progress</label>
                            <div id="pre-internship-pie"></div>
                        </div>
                        <div class="col-md-4">
                            <label>During-internship Progress</label>
                            <div id="during-internship-pie"></div>
                        </div>
                        <div class="col-md-4">
                            <label>End-internship Progress</label>
                            <div id="end-internship-pie"></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" width="500">Desc</th>
                                    <th scope="col">Remarks</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Updated Date</th>
                                </tr>
                            </thead>
                            <tbody id="table-body">
                            </tbody>
                        </table>
                        <div id="table-pagination"></div>
                    </div>
                @elseif (Auth::user()->deptChair)
                    <div class="row">
                        <div class="col-md-4">
                            <label>Intent Forms Application</label>
                            <div id="intent-form-pie"></div>
                        </div>
                        <div class="col-md-4">
                            <label>During-internship Progress</label>
                            <div id="during-dept-pie"></div>
                        </div>
                        <div class="col-md-4">
                            <label>End-internship Progress</label>
                            <div id="end-dept-pie"></div>
                        </div>
                    </div>
                @elseif (Auth::user()->sip)
                    <select class="form-control col-md-6" id="course">
                    </select>

                    <div class="row">
                        <div class="col-md-4">
                            <label>Pre internship Progress</label>
                            <div id="pre-sip-filtered-pie"></div>
                        </div>
                        <div class="col-md-4">  
                            <label>During-internship Progress</label>
                            <div id="during-sip-filtered-pie"></div>
                        </div>
                        <div class="col-md-4">
                            <label>End-internship Progress</label>
                            <div id="end-sip-filtered-pie"></div>
                        </div>
                    </div>
                    <h3>All Courses</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <label>Pre internship Progress</label>
                            <div id="pre-sip-all-pie"></div>
                        </div>
                        <div class="col-md-4">
                            <label>During-internship Progress</label>
                            <div id="during-sip-all-pie"></div>
                        </div>
                        <div class="col-md-4">
                            <label>End-internship Progress</label>
                            <div id="end-sip-all-pie"></div>
                        </div>
                    </div>
                @endif
            </div>
        </div>

        @if (Auth::user()->role_id == Status::STUDENT)
            <script type="text/javascript" src="{{ asset('js/student-dashboard.js') }}"> </script>
        @elseif (Auth::user()->deptChair)
            <script type="text/javascript" src="{{ asset('js/dept-chair-dashboard.js') }}"> </script>
        @elseif (Auth::user()->sip)
            <script type="text/javascript" src="{{ asset('js/sip-dashboard.js') }}"> </script>
        @endif
    @else
    
    @endif
    
    
    
@endsection
