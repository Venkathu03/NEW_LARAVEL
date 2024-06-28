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
      <title>Medisim Student SignUp</title>
         <style>
       
        input::-webkit-outer-spin-button,
          input::-webkit-inner-spin-button {
             -webkit-appearance: none;
          }
       
       </style>
   </head>
<body class="bg-login">
	<!--wrapper-->
	<div class="wrapper" style="background-color: #ffffff; background-image: url({{asset('assets/images/Ds/signin.png')}}); background-repeat: no-repeat; background-position: bottom left;">
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
										<h3 class="" style="text-align: left; font-size: 32px; font-family: Gilroy-SemiBold">OTP Verification</h3>
										<br>	
									</div>
									<div>
										<p style="text-align: left; font-size: 18px; font-family: Gilroy-Regular">No worries, We will guide you through the Reset Instruction:-</p>
									</div><br>

                                    
									
									<div class="form-body">
										<form class="row g-3" action="{{ route('student.verify.reset.otp')}}" method="post">
                                            @csrf
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label" style="text-align: left; font-size: 16px; font-family: Gilroy-Medium">Enter your OTP</label>
												<input type="number" class="form-control" name="otp" placeholder="Secret Code"><br><br>
											</div>
											<input type="hidden" name="reset_string" value="{{$student->reset_string}}">
											
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary" style="text-align: center; font-size: 20px; font-family: Gilroy-SemiBold">Verify</button>
												</div>
												<div class="login-separater text-center mb-4"> <span>OR</span>
										<hr/>
									
									<div class="text-center">
										
										
										<p>Back to <a href="{{ url('student/login')}}">Signin</a>
										</p>
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
	<!--end wrapper-->
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
	<script src="{{ asset('assets/js/app.js')}}"></script>
</body>
</html>