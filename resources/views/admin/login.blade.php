<!doctype html>
<html>
<head>
<meta charset="utf-8">
<!--<link rel="shortcut icon" href="favicon.ico" type="image/vnd.microsoft.icon" />-->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Laravel Demo</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('backend/css/style2.css') }}"> 

</head>
<body class="noJS fullbg">
<div class="container-fluid"> 
<div class="row">
<div class="midarea">
<div class="loginpage">
<div class="loginBox animated bounceInDown">
<div class="row">	
	<div class="col-12 col-sm-12 col-md-12">
	<div class="loginFormBox pb-2">

		@if (session('error'))
		<div class="alert alert-danger">
		{{ session('error') }}
		</div>
		@endif

		@if (session('success'))
		<div class="alert alert-success">
		{{ session('success') }}
		</div>
		@endif

		<form method="POST" action="{{ route('admin.login') }}" class="loginform" id="login_frm" autocomplete="off">
			@csrf
			<h1 class="httext">Login</h1>
			<ul class="radioBtnGroup">
				<li>
				<input value="Login" class="changelogin" name="Login" checked id="login" type="radio">
				<label for="login">Login</label>	
				</li>
			</ul>
			<div class="fieldRow">
			<div class="inputField userName">
			<input type="text" name="username" id="username" placeholder="Username" class="form-control {{ $errors->has('username') ? ' is-invalid' : '' }}" value="{{ old('username') }}" autocomplete="off">

			@if ($errors->has('username'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('username') }}</strong>
				</span>
			@endif			
			</div>
			</div>

			<div class="fieldRow">
			<div class="inputField password">
			<input type="password" name="password" id="password" placeholder="Password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" autocomplete="off">
			
			@if ($errors->has('password'))
				<span class="invalid-feedback" role="alert">
					<strong>{{ $errors->first('password') }}</strong>
				</span>
			@endif			
			</div>
			</div>	
			<div class="fieldRow">
			<input type="submit" value="Login" class="button login_frm"  />
			</div>
		</form>	
	</div>
	</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script src="{{ asset('backend/js/jquery-3.5.1.min.js') }}"></script> 
<script src="{{ asset('backend/js/bootstrap-4.2.1.js') }}"></script> 
<script src="{{ asset('backend/js/custom.js') }}"></script> 
</body>
</html>