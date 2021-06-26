<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Register</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('public/back_end/vendors/images/apple-touch-icon.png') }}">
	<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('public/back_end/vendors/images/favicon-32x32.png') }}">
	<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('public/back_end/vendors/images/favicon-16x16.png') }}">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/vendors/styles/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/vendors/styles/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('public/back_end/vendors/styles/style.css') }}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo">
				<a href="login.html">
					<img src="{{ asset('public/back_end/vendors/images/deskapp-logo.svg') }}" alt="">
				</a>
			</div>
			<div class="login-menu">
				<ul>
					<li><a href="login_client" style="color: #7faf51">Đăng Nhập</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center" style="
	background-color: #7faf51;">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center" style="color: #7faf51">Đăng Ký</h2>
						</div>
						@if($errors->any())
                            <div class="alert alert-danger alert-blog">{{ $errors->first() }}</div>
                        @endif
                        {{-- FORM --}}
						<form action="{{ URL::to('process_register_client') }}" method="post" style="text-align: center" >
							@csrf
                            <div class="input-group custom">
								<input type="text" name="username" class="form-control form-control-lg" placeholder="Họ và tên">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-user"></i></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="text" name="email" class="form-control form-control-lg" placeholder="Email">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-email-1"></i></span>
								</div>
							</div>
							<div class="input-group custom">
								<input type="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-padlock"></i></span>
								</div>
							</div>
                            <div class="input-group custom">
								<input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Xác nhận lại mật khẩu">
								<div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy dw dw-padlock"></i></span>
								</div>
							</div>
							{{-- <div class="row pb-30">
								<div class="col-6">
									<div class="custom-control custom-checkbox">
										<input type="checkbox" class="custom-control-input" id="customCheck1">
										<label class="custom-control-label" for="customCheck1">Remember</label>
									</div>
								</div>
								<div class="col-6">
									<div class="forgot-password"><a href="forgot-password.html">Forgot Password</a></div>
								</div>
							</div> --}}
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
										<!--
											use code for form submit
											<input class="btn btn-primary btn-lg btn-block" type="submit" value="Sign In">
										-->
										<input type="submit" class="btn btn-lg btn-block" style="
										background-color: #7faf51;" value="Đăng Ký" />
									</div>
									<div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">Hoặc</div>
									<div class="d-flex justify-content-between d-flex align-items-center" style="font-size: 22px">
										<div class="justify-content-start" style="background-color: rgb(214 214 214); width:45%; border-radius: 4px;">
											<a href="#"><span><i class="icon-copy fa fa-facebook-official" aria-hidden="true" style="color: #166fe5"></i> Facebook</span></a>
										</div>
										<div class="justify-content-end" style="background-color: rgb(214 214 214); width:45%; border-radius: 4px;">
											<a href="#"><span><i class="icon-copy fa fa-google" aria-hidden="true"></i> Google</span></a>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="{{ asset('public/back_end/vendors/scripts/core.js') }}"></script>
	<script src="{{ asset('public/back_end/vendors/scripts/script.min.js') }}"></script>
	<script src="{{ asset('public/back_end/vendors/scripts/process.js') }}"></script>
	<script src="{{ asset('public/back_end/vendors/scripts/layout-settings.js') }}"></script>
</body>
</html>
