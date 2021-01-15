<!DOCTYPE html>
<html>
<head>
	<title>eClinic: Doctor Login Page</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">		

	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom-css/eClinic.css') }}">

    <script type="text/javascript" src="{{ asset('js/jquery/jquery-3.4.1.min.js') }}"></script>
</head>
<body>
	<section class="loginpage container-fluid">
		<div class="loginform text-center">

			<div class="patlogo_container" style="colors:#980e0e;">
				<img  onclick="window.location.href=''" src="../images/app_logo.png">
			</div>
			
			<h5 class="mt-20 text-left">Sign In your Account</h5>

			<form method="POST" action="">
             @csrf

             	@if(Session::has('flash_message_error'))
					<div class="alert-danger ">
						<strong>{!! session('flash_message_error') !!}</strong>
					</div>
				@endif
				<input class="form-control @error('email') is-invalid @enderror" type="text" placeholder="Email address" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

				@error('email')
                    <span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
                @enderror

				<input id="password" type="password" class="form-control mt-10 @error('password') is-invalid @enderror" type="text" placeholder="Password" name="password" required autocomplete="current-password">

				@error('password')
                    <span class="invalid-feedback" role="alert">
                         <strong>{{ $message }}</strong>
                    </span>
                @enderror
				<span><a href="#">Forgot Password?</a></span>

				<button type="submit" class="btn login-btn">Sign In</button>
				<hr>
				<button type="button" class="btn create-acct-btn" onclick="window.location.href='{{ url('doctor/register') }}'">Create Account</button>
			</form>
		</div>
	</section>
</body>
</html> 