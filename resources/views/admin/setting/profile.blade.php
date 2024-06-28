@extends('admin.layouts.app')
@section('admin-content')

<div class="page-content">
	<div class="card shadow-none bg-transparent border-bottom border-2">
		<div class="card-body">
			<div class="row align-items-center">
				<div class="col-md">
					<h4 class="mb-3 mb-md-0">Settings</h4>
				</div>

			</div>
		</div>
	</div>



	<!--end row-->
	<div class="row row-cols-1 row-cols-xl-2">
		<div class="col-12 col-xl-6 d-flex">
			<div class="card radius-10 w-100">

				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-0" style="margin-top: 15px;">User Profile</h5>
						</div>

					</div>

					<div class="card radius-10" style="box-shadow: none;">
						<div class="card-body">
							<div class="d-flex align-items-center">
								@if(!is_null(auth('admin')->user()->image))
								<img src="{{asset('setting/'.auth('admin')->user()->image)}}" class="rounded-circle p-1 border" width="90" height="90" alt="..." style="border-radius: 0px!important">
								@else
								<img src="{{asset('assets/images/avatars/prof.png')}}" class="rounded-circle p-1 border" width="90" height="90" alt="..." style="border-radius: 0px!important">
								@endif
								<div class="flex-grow-1 ms-3">
									<h5 class="mt-0">{{auth('admin')->user()->username}}</h5>
								</div>
							</div>

						</div>
						@if (Session::has('profile-success'))
						<div class="alert alert-success">
							<div>
								<p>{{ Session::get('profile-success') }}</p>
							</div>
						</div>
						@endif
						<form class="row g-3" action="{{route('admin.update.profile')}}" method="post" enctype="multipart/form-data" onsubmit="return Validate(this);">
							@csrf

							<div class="row g-3">
								<label for="inputFirstName" class="form-label" style="margin-bottom: 0px;">Admin Name</label>
								<input type="name" placeholder="Name" class="form-control" id="inputFirstName" name="username" value="{{auth('admin')->user()->username}}" style="margin-top: 5px;">
							</div>
							<div class="row g-3">
								<label for="inputFirstName" class="form-label" style="margin-bottom: 0px;">Mobile Number</label>
								<input type="text" placeholder="" class="form-control" id="mobile" name="mobile" value="{{auth('admin')->user()->mobile}}" style="margin-top: 5px;">
								<span id="mobileError" style="color: red;"></span>
							</div>
							<div class="row g-3">
								<label for="inputFirstName" class="form-label" style="margin-bottom: 0px;">Email id</label>
								<input type="email" placeholder="name@gmail.com" class="form-control" id="email" name="email" required value="{{auth('admin')->user()->email}}" style="margin-top: 5px;">
							</div>
							<div class="row g-3">
								<label for="inputFirstName" class="form-label" style="margin-bottom: 0px;">Profile</label>
								<input type="file" class="form-control" id="image" name="image" accept=".jpg, .jpeg, .png" style="margin-top: 5px;">
							</div>

							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5">Save</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
		<div class="col d-flex">
			<div class="card radius-10 w-100">
				<div class="card-body">
					<div class="d-flex align-items-center">
						<div>
							<h5 class="mb-1" style="margin-left: 20px; margin-top: 15px; color: #40D5F7;">Change Password</h5>

						</div>

					</div>
					@if (Session::has('update-password'))
					<div class="alert alert-success">
						<div>
							<p>{{ Session::get('update-password') }}</p>
						</div>
					</div>
					@endif
					<div class="flex-grow-1 ms-3" style="margin-top: 20px;">
						<form class="row g-3" action="{{route('admin.change.password')}}" method="post">
							@csrf
							<div class="row g-3">
								<label for="inputFirstName" class="form-label" style="margin-bottom: 0px;">New Password</label>
								<input type="password" placeholder="********" class="form-control CheckPassword" name="password" id="Password" style="margin-top: 5px;">
							</div>
							<div class="row g-3">
								<label for="inputFirstName" class="form-label" style="margin-bottom: 0px;">Confirm Password</label>
								<input type="password" placeholder="********" class="form-control CheckPassword" id="ConfirmPassword" style="margin-top: 5px;">
							</div>
							<span style="margin-top: 7px;" id="passMatch"></span>
							<div class="col-12">
								<button type="submit" class="btn btn-primary px-5 btn-submit">Save</button>
							</div>

						</form>
					</div>

				</div>
			</div>
		</div>
	</div>
	<!--end row-->


	<!--end row-->

</div>
<!--end page wrapper -->
<!--start overlay-->
<div class="overlay toggle-icon"></div>

@endsection
@section('scripts')
<script>
	$(document).ready(function() {
		$(".CheckPassword").on('keyup', function() {
			var password = $("#Password").val();
			var confirmPassword = $("#ConfirmPassword").val();

			if (password != confirmPassword) {
				$("#passMatch").html("Password does not match !").css("color", "red");
				$(".btn-submit").prop("disabled", true);
			} else {
				if ($("#Password").val().lengh > 6) {
					$("#passMatch").html("Password Must be atleast 6 character !").css("color", "red");
					$(".btn-submit").prop("disabled", true);
				}
				$("#passMatch").html("").css("color", "green");
				$(".btn-submit").prop("disabled", false);
			}
		});
	});


	// Get the mobile number input field and error message span element
	const mobileInput = document.getElementById("mobile");
	const mobileError = document.getElementById("mobileError");

	// Function to validate the mobile number
	function validateMobile() {
		const mobilePattern = /^[0-9]{10}$/; // Assuming a 10-digit mobile number
		const mobileValue = mobileInput.value;

		if (!mobilePattern.test(mobileValue)) {
			mobileError.textContent = "Please enter a valid 10-digit mobile number.";
			mobileInput.classList.add("is-invalid");
			return false;
		} else {
			mobileError.textContent = "";
			mobileInput.classList.remove("is-invalid");
			return true;
		}
	}

	// Listen for input events and validate the mobile number
	mobileInput.addEventListener("input", validateMobile);
</script>
@endsection