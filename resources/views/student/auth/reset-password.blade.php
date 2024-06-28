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
	<title>Medisim Admin Login</title>
    
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
							<img src="{{asset('assets/images/Ds/logo.png')}}" width="250" alt="" />
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
										<h3 class="" style="text-align: left; font-size: 32px; font-family: Gilroy-SemiBold">Reset Password</h3>
										<br>	
									</div>
									<div>
										<p style="text-align: left; font-size: 18px; font-family: Gilroy-Regular">No worries, We will guide you through the Reset Instruction:-</p>
									</div><br>
				        <form class="row g-3" action="{{ route('store.student.password')}}" method="post">
                            @csrf
									<div class="form-body">
										    <div class="col-12">
												<label for="inputEmailAddress" class="form-label" style="text-align: left; font-size: 16px; font-family: Gilroy-Medium">Enter New Password</label>
												<input type="password" class="form-control CheckPassword" name="password" id="Password" placeholder="New Password" required>
											</div>
											<div class="col-12">
												<label for="inputEmailAddress" class="form-label" style="text-align: left; font-size: 16px; font-family: Gilroy-Medium">Re Enter New Password</label>
												<input type="password" class="form-control CheckPassword" id="ConfirmPassword" name="password" placeholder="Confirm Password" required><br><br>
											</div>
                                        <span id="CheckPasswordMatch"></span>
											<div class="col-12">
												<div class="d-grid">
													<button type="submit" class="btn btn-primary btn-submit" style="text-align: center; font-size: 20px; font-family: Gilroy-SemiBold">Reset Password</button>
												</div>
                                                <input type="hidden" name="verify_email" value="{{$student->email}}">
				                            <div class="login-separater text-center mb-4"> <span>OR</span>
										          <hr/>
                                                <div class="text-center">
                                                    <p>Back to <a href="{{ url('student/login')}}">Signin</a>
                                                    </p>
                                                </div>
                                                </div>
									       </div>
								</div>
                            </form>
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
        
           $(".CheckPassword").on('keyup', function(){
            var password = $("#Password").val();
            var confirmPassword = $("#ConfirmPassword").val();
               var strength = 1;
            /*length 5 characters or more*/
             if(this.value.length <= 5) {
                 strength++; 
                 $("#CheckPasswordMatch").html("Password Must be atleast 6 character !").css("color","red");
                 $(".btn-submit").prop("disabled", true);
            }else{
                if (password != confirmPassword) {
                    $("#CheckPasswordMatch").html("Password does not match !").css("color","red");
                    $(".btn-submit").prop("disabled", true);
                }
                else{
                    $("#CheckPasswordMatch").html("").css("color","green");
                    $(".btn-submit").prop("disabled", false);
                }
            }
       });
        
	</script>
	
	<!--app JS-->
	<script src="{{ asset('assets/js/app.js')}}"></script>
</body>



</html>