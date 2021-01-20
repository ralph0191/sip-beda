<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'San Beda College Alabang') }}</title>

    <!-- Scripts -->
    
    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/moment.js') }}"></script>
    <script src="{{ asset('js/global.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/util.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/library/alertify.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/library/pagination.min.js') }} "></script>
    <script type="text/javascript" src="{{ asset('js/library/jquery.blockUI.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome 5.8.2 -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome-free-5.8.2-web/css/all.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link href="{{ asset('css/simple-sidebar.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<style>
* {
  box-sizing: border-box;
}

.column {

  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
  width: 10%;
  padding-top: 750px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
 
}

.apphomebg {
    background-image:url('/images/sbca-cover.jpg');
    background-size: 100% 700px;
    background-repeat: no-repeat;
    background-position: right 0px top 75px;


}
</style>
<body class="{{!Auth::user() ? 'apphomebg' : ''}}">
    <div id="app">
        @if (Auth::user())
            <!-- Sidebar -->
            <div class="d-flex" id="wrapper">
                @include('layouts.side-bar')

                <!-- Page Content -->

                <div id="page-content-wrapper">
                    @include('layouts.nav-bar')

                    @yield('content')
                </div>  
            </div>
        @else 
            <nav class="navbar navbar-expand-md navbar-light shadow-sm" style="background-color:#980e0e;">

                <a class="navbar-brand" href="{{ url('/') }}" >
                    <img src="{{asset('images/sbcalogo.png')}}" alt="SBCA" width="auto" height="50px" style="padding-left:50px;">
                </a>
                <div class="container" >
                
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}" >
                        <span class="navbar-toggler-icon" ></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent" >
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                @if (Route::has('login'))
                                    <li class="nav-item">
                                        <a style="color:#fff;" class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                    </li>
                                @endif
                                
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a style="color:#fff;" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
            @yield('content')               
            <div class="row">
                <div class="column">
                    <img src="{{asset('images/STbenidict.png')}}" alt="St. Benedict" style="width:100%">
                    <center><p>Catholic Christian in Principle</p></center>
                   
                    <p>Follow Christ in His teachings as preached by the Catholic Church and Live the Gospel of loving fellowship and concern for one another, especially the poor.</p>
                </div>

                <div class="column">
                    <img src="{{asset('images/Medallion.png')}}" alt="Medallion" style="width:100%">
                    <center><p>Benedictine in Orientation</p></center>

                    <p>Appreciate and sustain a life of prayer through the liturgy, Value work according to one’s calling, Participate in building a community through commitment of justice and peace and Pursue a lifelong search for knowledge and truth.</p>
                </div>

                <div class="column">
                    <img src="{{asset('images/Filipino.png')}}" alt="Filo" style="width:100%">
                    <center><p>Filipino in Character</p></center>
                    
                    <p>Have deep love for country and its rich and varied heritage, and respect for language, culture and the environment and Are always ready to share themselves, their capabilities, training and learning in the service of community and nation.</p>
                </div>
            </div>
        @endif
    </div>
</body>
</html>
