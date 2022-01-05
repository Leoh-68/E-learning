<!DOCTYPE html>
<html lang="en">
<head>
	<title>New Password</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	 <meta name="csrf-token" content="{{ csrf_token() }}">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }} "/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }} ">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }} ">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>

<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">	
				<form action="{{ route('mat-khau-moi',['id'=>$user->id]) }}" method="POST"  class="login100-form validate-form" button type = 'submit'  >	
				@csrf	 
					<span class="login100-form-title p-b-53">	
						New Password
					</span>
					
					
					@if (!empty($title))
						<div class="alert alert-danger">
						<ul>
						<li>{{$title }}</li>
						</ul>
						</div>
					@endif
					
                    <div class="p-t-13 p-b-9">
						<span class="txt1">
							Password
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100 @error('password') is-invalid @enderror " type="password" name="password" value="{{ old('password') }}" required>
						<span class="focus-input100"></span>
					
					</div>
					@error('password')
						<div>
						<span class="alert alert-danger">>{{ $message }}</span>
						</div>
					@enderror
					
					<div class="p-t-13 p-b-9">
						<span class="txt1">
							Confirmed Password
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100 @error('password') is-invalid @enderror " type="password" name="password2" value="{{ old('password2') }}" required>
						<span class="focus-input100"></span>
					
					</div>
					@error('password2')
						<div>
						<span class="alert alert-danger">>{{ $message }}</span>
						</div>
					@enderror
					<div class="container-login100-form-btn m-t-17">
						<button class="login100-form-btn">
							Xác nhận
						</button>
					</div>
					<div class="container-login100-form-btn m-t-17">
						<a href="{{ route('xl-dang-nhap') }}" >
							Back to Login
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/main.js') }}"></script>
    
</html>