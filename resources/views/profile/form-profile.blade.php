@extends('layouts.app')

@section('content')
    @if (Auth::user()) 
        <div class="content">
            <div class="row">
                <div class="col-md-8">
                    <div class="card-header">
                        <h5 class="title">Edit Profile</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" id="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}">
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile Number</label>
                                    <input type="text" id="mobile_number" class="form-control" placeholder="Mobile Number" value="{{Auth::user()->mobile_number}}" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" id="first_name" class="form-control" placeholder="First Name" value="{{Auth::user()->first_name}}">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input type="text" id="middle_name" class="form-control" placeholder="Middle Name" value="{{Auth::user()->middle_name}}">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" id="last_name" class="form-control" placeholder="Last Name" value="{{Auth::user()->last_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" id="address" class="form-control" placeholder="Home Address" value="{{Auth::user()->address}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <center>
                                    <button class="btn btn-primary" id="submit">
                                        Submit Changes
                                    </button>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4" style="padding-top:70px; padding-right:70px;">
                    <div class="card card-user">
                        <div class="image">
                        </div>
                        <div class="card-body">
                            <div class="author">
                                
                                <center> <img class="avatar border-gray profile-pic" src="{{asset('images/me.jpg')}}" alt="..."> </center>
                                <div>
                                    <i class="fa fa-camera upload-button"></i>
                                    <input class="file-upload" id="file" type="file" accept="image/*"/>
                                </div>
                                
                                <h5 class="title">{{ Auth::user()->first_name . " ". Auth::user()->last_name }}</h5>
                                <p class="description">
                                    @if (Auth::user()->role_id == Status::STUDENT)
                                        {{Auth::user()->student->course->name}}
                                    @elseif (Auth::user()->role_id == Status::SIP)
                                        SIP
                                    @elseif (Auth::user()->role_id == Status::DEPT_CHAIR)
                                        {{Auth::user()->deptChair->course->name}}
                                    @endif
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <center>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                            Change Password
                                        </button>
                                    </center>
                                </div> 
                            </div>
                        <div class="col-md-12">
                            <center>
                                <button class="btn btn-primary" id="submit">
                                    Submit Changes
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Change Password</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" id="current_password" class="form-control" placeholder="Current password" value="">
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label> New Password</label>
                                <input type="password" id="password" class="form-control" placeholder="New Password" value="">
                            </div>
                        </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label> Confirm Password</label>
                                <input type="password" class="form-control" placeholder=" Confirm Password" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @else
    
    @endif
    
    
    <script type="text/javascript" src="{{ asset('js/custom-js/profile/user-profile.js') }}"> </script>
@endsection
