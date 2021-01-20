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
                            <div class="col-md-5 pr-1">
                                <div class="form-group">
                                <label>Company (disabled)</label>
                                <input type="text" class="form-control" disabled="" placeholder="Company" value="Creative Code Inc.">
                                </div>
                            </div>
                            <div class="col-md-3 px-1">
                                <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" placeholder="Username" value="michael23">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control" placeholder="Company" value="sa">
                                </div>
                            </div>
                            <div class="col-md-6 pl-1">
                                <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" value="Andrew">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-4 pr-1">
                                <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" placeholder="City" value="Mike">
                                </div>
                            </div>
                            <div class="col-md-4 px-1">
                                <div class="form-group">
                                <label>Country</label>
                                <input type="text" class="form-control" placeholder="Country" value="Andrew">
                                </div>
                            </div>
                            <div class="col-md-4 pl-1">
                                <div class="form-group">
                                <label>Postal Code</label>
                                <input type="number" class="form-control" placeholder="ZIP Code">
                                </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>About Me</label>
                                <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
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
                        <h5 class="title">{{ Auth::user()->name}}</h5>
                        </a>
                        <p class="description">
                        michael24
                        </p>
                    </div>
                    <p class="description text-center">
                        "Lamborghini Mercy <br>
                        Your chick she so thirsty <br>
                        I'm in that two seat Lambo"
                    </p>
                    </div>
                    <hr>
                </div>
                </div>
            </div>
        </div>
    @else
    
    @endif
    
    
@endsection
