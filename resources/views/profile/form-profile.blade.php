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
                    <form>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control" placeholder="Email" value="{{Auth::user()->email}}">
                                </div>
                            </div>
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile Number</label>
                                    <input type="email" class="form-control" placeholder="Mobile Number" >
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" placeholder="First Name" value="{{Auth::user()->first_name}}">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Middle Name</label>
                                    <input type="text" class="form-control" placeholder="Middle Name" value="{{Auth::user()->middle_name}}">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" placeholder="Last Name" value="{{Auth::user()->last_name}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" class="form-control" placeholder="Home Address" value="{{Auth::user()->address}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-6 pr-1">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" class="form-control" placeholder="Password" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-6 pl-1">
                                        <div class="form-group">
                                            <label>Current Password</label>
                                            <input type="password" class="form-control" placeholder="Current password" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <div class="col-md-12">
                            <center>
                                <button class="btn btn-primary" href="#">
                                    Submit Changes
                                </button>
                            </center>
                        </div>
                        </div>
                    </form>
                </div>
                </div>
                <div class="col-md-4" style="padding-top:70px; padding-right:70px;">
                <div class="card card-user">
                    <div class="image">
                    </div>
                    <div class="card-body">
                        <div class="author">
                            <a href="#">
                            <img class="avatar border-gray" src="{{asset('images/me.jpg')}}" alt="...">
                            <h5 class="title">{{ Auth::user()->last_name}}</h5>
                            </a>
                            <p class="description">
                            michael24
                            </p>
                        </div>
                        {{-- <p class="description text-center">
                            "Lamborghini Mercy <br>
                            Your chick she so thirsty <br>
                            I'm in that two seat Lambo"
                        </p> --}}
                    </div>
                    <hr>
                </div>
                </div>
            </div>
        </div>
    @else
    
    @endif
    
    
@endsection
