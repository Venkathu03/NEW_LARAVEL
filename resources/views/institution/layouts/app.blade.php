<!doctype html>
<html lang="en">



<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="assets/images/Ds/logo.png" type="image/png" />
     @include('institution.layouts.style')
	<title>Medisim VR</title>
</head>

<body>
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
        @include('institution.layouts.sidebar')
        @include('institution.layouts.header')
		<div class="page-wrapper">
			<div class="page-content">
            @yield('institution-content')
				
			</div>
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
		<footer class="page-footer">
			<p class="mb-0">Copyright &copy; 2023. All right reserved.</p>
		</footer>
	</div>
    @include('institution.layouts.script')
     @yield('scripts')


	
</body>




</html>