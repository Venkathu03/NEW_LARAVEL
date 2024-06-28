<!doctype html>
<html lang="en">



<head>
	<!--plugins-->
	<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('assets/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js')}}"></script>

	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/css/app.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{ asset('assets/css/header-colors.css')}}" />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<title>Medisim VR - Students</title>
	<style>
		.blured {
			filter: blur(2px);
  			-webkit-filter: blur(2px);
			pointer-events: none;
		}
	</style>
	<script>
	$(document).ready(function(){
		$("#myModal").modal('show');
        
        $(".razorpay-payment-button").addClass('btn btn-primary');
	});
</script>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
	
		<header>
			<div class="topbar d-flex align-items-center" style="left: 0px!important;">
				<nav class="navbar navbar-expand">
					<div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
					</div>
					<div class="search-bar flex-grow-1">
						
						<div class="position-relative search-bar-box">
							<img src="{{ asset('assets/images/Ds/logo.png')}}"  alt="logo icon" width="15%">
						</div>
					</div>
					<div class="user-box dropdown">
						<a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="{{ asset('assets/images/avatars/user.jpg')}}" class="user-img" alt="user avatar">
							<div class="user-info ps-3">
								<p class="user-name mb-0">{{ auth('student')->user()->fullname}}</p>
							</div>
						</a>
						<ul class="dropdown-menu dropdown-menu-end">
						<li><a class="dropdown-item" href="{{ route('student.logout.submit') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class='bx bx-log-out-circle'></i><span>Logout</span></a>
                                <form id="logout-form" action="{{ route('student.logout.submit') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
							</li>
                            
						</ul>
					</div>
				</nav>
			</div>
		</header>
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper" style="margin-left: 0px!important;">
			<div class="page-content">
				<div class="authentication-forgot d-flex align-items-center justify-content-center" style=" height: 80vh!important;">
					<div class="card forgot-box">
						<div class="card-body" style="width: 100%; padding: 60px;">
							
								<div>
									<img src="{{ asset('assets/images/Ds/Payment.png')}}"  alt="logo icon" width="25%" style="display: block; margin-left: auto;margin-right: auto;">
								</div>
								<br><br>

								<div>
									<h4 style="text-align: center; font-size: 24px; font-family: Gilroy-Semibold">Your Payment Completed Successfully!</h4>
								</div>

<!--
								<div>
									<p style="text-align: center; font-size: 16px; font-family: Gilroy-Regular; color: #898989;">Transaction Number : 29201283947347</p>
								</div>
-->
								<hr style="border-top: 1px dashed #000000; width: 100%;">

								<div>
									<p style="text-align: center; font-size: 16px; font-family: Gilroy-Medium">This Session will automatically logout in <span style="color: red;"><span id="countdown">5</span></span> Second </p>
								</div>
												
								
							
						</div>
					</div>
				</div>
				<!--end row-->
				
				
			</div>
		</div>
		<!--end page wrapper -->
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer" style="left: 0px!important;">
			<p class="mb-0">Copyright © 2023. All right reserved.</p>
		</footer>
	</div>

	<!-- Bootstrap JS -->
	<script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	
	
	<script src="{{ asset('assets/js/index.js')}}"></script>
	<script src="{{ asset('assets/js/index2.js')}}"></script>
	<!--app JS-->
	<script src="{{ asset('assets/js/app.js')}}"></script>

<script>
               document.addEventListener('DOMContentLoaded', function() {
                let countdownValue = 5;
                const countdownSpan = document.getElementById('countdown');
                // Function to update the countdown value in the span
                function updateCountdown() {
                    countdownSpan.innerText = countdownValue;
                    countdownValue--;
                    if (countdownValue < 0) {
                        clearInterval(countdownInterval);
                       // countdownSpan.innerText = 'Done';
                        document.getElementById('logout-form').submit();
                    }
                }
                const countdownInterval = setInterval(updateCountdown, 1000);
            });
      
</script>
</body>




</html>