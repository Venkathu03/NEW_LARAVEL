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
					<div class="col-12 col-xl-12 d-flex">
						<div class="card radius-10 w-100">
							
							<div class="card-body">
									

									<div class="card radius-10" style="box-shadow: none;">
										
                                        @if (Session::has('success'))
                                                <div class="alert alert-success">
                                                    <div>
                                                        <p>{{ Session::get('success') }}</p>
                                                    </div>
                                                </div>
                                            @endif
										<form class="row g-3" action="{{route('admin.update.settings')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                          <input type="hidden" name="setting_key" value="terms-and-condition">
											<div class="row g-3">
                                                <label>Terms and Conditions</label>
                                                <textarea  class="form-control" name="value" id="inputFirstName"  value="{{!is_null($setting) ? $setting->value:''}}" style="margin-top: 5px;">{{!is_null($setting) ? $setting->value:''}}</textarea>
											</div>
											<div class="col-12">
												<button type="submit" class="btn btn-primary px-5">Save</button>
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
    $(document).ready(function () {      
   $(".CheckPassword").on('keyup', function(){
        var password = $("#Password").val();
        var confirmPassword = $("#ConfirmPassword").val();
           
        if (password != confirmPassword) {
            $("#passMatch").html("Password does not match !").css("color","red");
            $(".btn-submit").prop("disabled", true);
        }
        else{
            if($("#Password").val().lengh > 6 )
             {
                $("#passMatch").html("Password Must be atleast 6 character !").css("color","red");
                $(".btn-submit").prop("disabled", true);
             }
            $("#passMatch").html("").css("color","green");
            $(".btn-submit").prop("disabled", false);
        }
   });
});

</script>
@endsection