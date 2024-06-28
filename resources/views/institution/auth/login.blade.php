<!doctype html>
<html lang="en">



<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{ asset('assets/images/Ds/logo.png')}}" type="image/png" />
	<!--plugins-->
	<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet">
	<title>Medisim Insitution Login</title>
</head>

<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper" style="background-color: #ffffff; background-image: url({{ asset('assets/images/Ds/signin.png')}}); background-repeat: no-repeat; background-position: bottom left;">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2">
					<div class="col">
						<div style="margin-left: 50px; margin-top: 50px;">
							<img src="{{ asset('assets/images/Ds/logo.png')}}" width="250" alt="" />
						</div>
					</div>

					<div class="col">
						
						<div class="card-1" style="box-shadow:">
							<div class="card-body">
								<div class="border p-4 rounded" style="border-color: #ffffff!important;">
									<div class="mb-4 text-center" style="text-align:left!important;">
										
									</div>
									<div style="padding: 25px;"></div>
									<div class="text-center">
										<h3 class="" style="text-align: left; font-size: 32px; font-family: Gilroy-SemiBold">Sign in</h3>
										<br><br>
										
									</div>
									
									<div class="form-body">
											@include('student.layouts.messages')
										<form class="row g-3" method="post" action="{{ route('institution.login')}}">
											@csrf
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label" style="text-align: left; font-size: 18px; font-family: Gilroy-Medium">Name</label>
												<input type="email" class="form-control" required name="email" placeholder="Email Address">
											</div>
											<div class="col-12">
												<label for="inputChoosePassword" class="form-label" style="text-align: left; font-size: 18px; font-family: Gilroy-Medium">Password</label>
												<div class="input-group" id="show_hide_password">
													<input type="password" required class="form-control" name="password"  placeholder="Enter Password">
												</div>
											</div>
											
											<div class="col-md-6">
												<div class="form-check form-switch" style="padding-left: 0px">
													<input type="checkbox" value="lsRememberMe" id="rememberMe"> <label for="rememberMe" required style="text-align: left; font-size: 14px; font-family: Gilroy-Regular">Remember me</label>
 													
												</div>
											</div>

<!--
											<div class="col-md-6 text-end">	<a href="#" style="text-align: left; font-size: 14px; font-family: Gilroy-Regular">Forgot Password ?</a>
											</div>
-->
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary" style="text-align: center; font-size: 20px; font-family: Gilroy-SemiBold">Login</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
					
				</div>
				<!--end row-->
			</div>
		</div>
	</div>
	<!--end wrapper-->
	<!-- Bootstrap JS -->
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<!--Password show & hide js -->
	<script>
		$(document).ready(function () {
			$("#show_hide_password a").on('click', function (event) {
				event.preventDefault();
				if ($('#show_hide_password input').attr("type") == "text") {
					$('#show_hide_password input').attr('type', 'password');
					$('#show_hide_password i').addClass("bx-hide");
					$('#show_hide_password i').removeClass("bx-show");
				} else if ($('#show_hide_password input').attr("type") == "password") {
					$('#show_hide_password input').attr('type', 'text');
					$('#show_hide_password i').removeClass("bx-hide");
					$('#show_hide_password i').addClass("bx-show");
				}
			});
		});
	</script>
	
	<!--app JS-->
	<script src="assets/js/app.js"></script>
</body>



</html>