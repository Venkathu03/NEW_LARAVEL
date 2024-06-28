@extends('student.layouts.app')
@section('student-content')

    @if (Session::has('password-sec'))
     @php $master_type = 'password-sec'; @endphp
    @elseif (Session::has('profile-sec'))
      @php $master_type = 'profile-sec'; @endphp
    @else
        @php $master_type ='';@endphp
@endif

<div class="card shadow-none bg-transparent border-bottom border-2">
					<div class="card-body">
						<div class="row align-items-center">
							<div class="col-md">
								<h4 class="mb-3 mb-md-0">Settings</h4>
							</div>
							
						</div>
					</div>
				</div>
				<!--breadcrumb-->
				<div class="col">
						
						<div class="card">
							<div class="card-body">
								<ul class="nav nav-tabs nav-primary" role="tablist">
									<li class="nav-item" role="presentation">
										<a class="nav-link @if($master_type =='' ) {{'active'}} @endif" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="true">
											<div class="d-flex align-items-center">
												
												<div class="tab-title">Profile</div>
											</div>
										</a>
									</li>
									<li class="nav-item" role="presentation">
										<a class="nav-link @if( $master_type =='password-sec') {{'show active'}} @endif" data-bs-toggle="tab" href="#primarychange" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												
												<div class="tab-title">Change Password</div>
											</div>
										</a>
									</li>
                                    
                                    <li class="nav-item" role="presentation">
										<a class="nav-link @if( $master_type =='profile-sec') {{'show active'}} @endif" data-bs-toggle="tab" href="#primarychange1" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												
												<div class="tab-title">Change Profile</div>
											</div>
										</a>
									</li>
                                    
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primarysubscription" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												
												<div class="tab-title">Subscription</div>
											</div>
										</a>
									</li>
<!--
									<li class="nav-item" role="presentation">
										<a class="nav-link" data-bs-toggle="tab" href="#primarypuser" role="tab" aria-selected="false">
											<div class="d-flex align-items-center">
												
												<div class="tab-title">User Feedback</div>
											</div>
										</a>
									</li>
-->

								</ul>
								<div class="tab-content py-3">
									<div class="tab-pane fade @if($master_type =='' ) {{'show active'}} @endif" id="primaryprofile" role="tabpanel">
                                        
                                        
										<div style="width: 100%; display: flex; align-items: center;">
                                           
                                            
											<div>
                                                @if(!is_null($student->avatar))
												    <img src="{{asset('setting/'.$student->avatar)}}" style="width:100px;">
                                                @else
                                                    <img src="{{asset('assets/images/avatars/prof.png')}}" style="width:100px;">
                                                @endif
											</div>
											<div style="margin-left: 20px;">
												<h4>{{$student->fullname}}</h4>
												<p>{{$student->institution->institution_name}}</p>
											</div>
										</div>
										<div style="width: 100%; display: flex; align-items: center; background-color: #F2F2F2; padding-top: 10px; padding-bottom: 10px;">
											<div style="width: 50%;">
												<h5 style="margin-left: 10px;">Profile Information</h5>
											</div>
<!--
											<div style="margin-left: 20px; width: 50%;">
												<button class="button-video" style="float: right;"><i class="fadeIn animated bx bx-edit-alt" style="margin-right: 10px;"></i>Edit</button>											</div>
-->
										</div>
										
										<div class="card-body p-5">
											
											<form class="row g-3">
												<div class="col-md-6">
													<label for="inputFirstName" class="form-labell">User Name</label>
													<p>{{$student->fullname}}</p>
												</div>
												<div class="col-md-6">
													<label for="inputLastName" class="form-labell">Instition Name</label>
													<p>{{$student->institution->institution_name}}</p>
												</div>
												<div class="col-md-6">
													<label for="inputEmail" class="form-labell">Batch</label>
												    <p>{{$student->batch_year}}</p>
												</div>
												<div class="col-md-6">
													<label for="inputLastName" class="form-labell">Course Name</label>
													<p>{{$student->course->course_name}}</p>
												</div>
												
												<div class="col-md-6">
													<label for="inputLastName" class="form-labell">Mobile Number</label>
													<p>{{$student->phone_number}}</p>
												</div>
												<div class="col-md-6">
													<label for="inputFirstName" class="form-labell">Email Id</label>
													<p>{{$student->email}}</p>
												</div>
												<div class="col-md-6">
													<label for="inputLastName" class="form-labell">Years of Study</label>
													<p>{{$student->study_year}}</p>
												</div>

											</form>
										</div>									
									</div>
									<div class="tab-pane fade @if( $master_type =='password-sec') {{'show active'}} @endif" id="primarychange" role="tabpanel">
                                          @if (Session::has('update-password'))
                                                <div class="alert alert-success">
                                                    <div>
                                                        <p>{{ Session::get('update-password') }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                          @if (Session::has('error-password'))
                                                <div class="alert alert-danger">
                                                            <div>
                                                                <p>{{ Session::get('error-password') }}</p>
                                                            </div>
                                                </div>
                                            @endif
												
										<div class="card-title d-flex align-items-center" style="margin-top: 80px;">
                                          
												<h5 class="mb-0 text-info" style="font-weight: 500; font-size: 16px; font-family: Gilroy-Semibold; color: #000000!important;">Change Password</h5>
											</div>
								    <form action="{{route('student.change.password')}}" method="post">
                                         @csrf
											<div class="row mb-3" style="margin-bottom: 30px!important; margin-top: 50px;">
												<label for="inputEnterYourName" class="col-sm-3 col-form-label" style="font-weight: 500; font-size: 16px; font-family: Gilroy-Regular; color: #000000!important;">Current Password</label>
												<div class="col-sm-6">
													<input type="text" class="form-control" placeholder="Current Password" name="current_password" id="current_password" style="border:none; background-color: #F2F2F2; font-family: Gilroy-Regular; font-size: 14px; font-weight: 400; color: #b0abab;">
<!--
													<p style="padding-top: 10px;"><a href="authentication-signup.html" style="font-weight: 500; font-size: 16px; font-family: Gilroy-SemiBold; color: #000000!important;">Forgot Password?</a>
													</p>
-->
												</div>

											</div>
											
											<div class="row mb-3" style="margin-bottom: 30px!important;">
												<label for="inputEnterYourName" class="col-sm-3 col-form-label" style="font-weight: 500; font-size: 16px; font-family: Gilroy-Regular; color: #000000!important;">New Password</label>
												<div class="col-sm-6">
													<input type="text" class="form-control CheckPassword"  name="password" id="Password" placeholder="New Password" style="border:none; background-color: #F2F2F2; font-family: Gilroy-Regular; font-size: 14px; font-weight: 400; color: #b0abab;">
													
												</div>

											</div>
											<div class="row mb-3" style="margin-bottom: 30px!important;">
												<label for="inputEnterYourName" class="col-sm-3 col-form-label" style="font-weight: 500; font-size: 16px; font-family: Gilroy-Regular; color: #000000!important;">Verify Password</label>
												<div class="col-sm-6">
													<input type="text" class="form-control CheckPassword"  id="ConfirmPassword"  placeholder="Verify Password" style="border:none; background-color: #F2F2F2; font-family: Gilroy-Regular; font-size: 14px; font-weight: 400; color: #b0abab;">
													 <span style="margin-top: 7px;" id="passMatch"></span>
												</div>

											</div>
											

											<div class="row">
                                                 
												<div class="col-sm-9">
													<a href="{{ url('student/dashboard')}}" class="btn btn-primary px-5"><i class="lni lni-cross-circle" style="margin-right: 10px;"></i>Cancel</a>
													<button type="submit" class="btn btn-primary px-5 btn-submit"><i class="fadeIn animated bx bx-copy" style="margin-right: 10px;"></i>Save</button>
												</div>
											</div>
                                        </form>
									</div>
                                    
                                    <div class="tab-pane fade @if( $master_type =='profile-sec') {{'show active'}} @endif" id="primarychange1" role="tabpanel">
                                          @if (Session::has('update-profile'))
                                                <div class="alert alert-success">
                                                    <div>
                                                        <p>{{ Session::get('update-profile') }}</p>
                                                    </div>
                                                </div>
                                            @endif
                                          @if (Session::has('error-profile'))
                                                <div class="alert alert-danger">
                                                            <div>
                                                                <p>{{ Session::get('error-profile') }}</p>
                                                            </div>
                                                </div>
                                            @endif
												
										<div class="card-title d-flex align-items-center" style="margin-top: 80px;">
                                          
												<h5 class="mb-0 text-info" style="font-weight: 500; font-size: 16px; font-family: Gilroy-Semibold; color: #000000!important;">Change Profile</h5>
											</div>
								    <form action="{{route('student.change.profile')}}" method="post" enctype="multipart/form-data" method="post" onsubmit="return Validate(this);">
                                         @csrf
											<div class="row mb-3" style="margin-bottom: 30px!important; margin-top: 50px;">
												<label for="inputEnterYourName" class="col-sm-3 col-form-label" style="font-weight: 500; font-size: 16px; font-family: Gilroy-Regular; color: #000000!important;">Profile Image</label>
												<div class="col-sm-6">
													<input type="file" class="form-control" placeholder="Current Password" name="image" id="image" style="margin-top: 5px;" accept="image/png, image/gif, image/jpeg">
												</div>
											</div>
											<div class="row">
												<label class="col-sm-3 col-form-label"></label>
												<div class="col-sm-9">
													<a href="{{ url('student/dashboard')}}" class="btn btn-primary px-5"><i class="lni lni-cross-circle" style="margin-right: 10px;"></i>Cancel</a>
													<button type="submit" class="btn btn-primary px-5 btn-submit"><i class="fadeIn animated bx bx-copy" style="margin-right: 10px;"></i>Save</button>
												</div>
											</div>
                                        </form>
									</div>
                                    
									<div class="tab-pane fade" id="primarysubscription" role="tabpanel">
										<div style="padding: 15px 0px; background-color: #F2F2F2;">
											<h4 style="font-size: 16px; font-weight: 500; font-family: Gilroy-SemiBold;margin-left:10px;">Subscription </h4>
										</div>
										<div style="padding: 25px 0px;">
											<h4 style="font-size: 16px; font-weight: 500; font-family: Gilroy-SemiBold;">Current Plan</h4>
										</div>
										<div style="padding: 30px 20px; width: 45%; border: 1px solid #d3cfcf; border-radius: 15px;">
											<div style="display: flex; width: 50%;">
												<h4 style="font-size: 24px; font-weight: 500; font-family: Gilroy-Bold;">{{$student->course->course_name}}</h4>
												<h4 style="font-size: 14px; font-weight: 400; font-family: Gilroy-Regular; margin-top: 10px;">/{{ IntoString($student->study_year)}} Year</h4>
											</div>
											<div style="display: flex; width: 50%;">
												<h4 style="font-size: 24px; font-weight: 500; font-family: Gilroy-Bold;">{{$subscription_fee.' INR'}}</h4>
												<h4 style="font-size: 14px; font-weight: 400; font-family: Gilroy-Regular; margin-top: 10px;">/Per Year</h4>
											</div>
											<h6 style="font-size: 20px; font-family: Gilroy-SemiBold; color: #0dcaf0">Subscription End Date</h6>
											<p style="font-size: 14px; font-weight: 400; font-family: Gilroy-Regular;">{{$subscription_end_at}}</p>
											
										</div>
										
										<div style="padding-top: 30px;">
											<h6 class="mb-0">Payment Status </h6>
											
											<div class="card">
												<div class="card-body">
													<table class="table mb-0">
														<thead style="background-color: #E4E4E4;">
															<tr>
																<th scope="col">S.No</th>
																<th scope="col">Amount</th>
																<th scope="col">Payment date</th>
																<th scope="col">Status</th>
															</tr>
														</thead>
														<tbody>
                                                            @foreach($payments as $key=>$payment)
															<tr>
																<th scope="row">{{$key+1}}</th>
																<td>{{$payment->amount.' INR'}}</td>
																<td>{{ date('d.m.Y', strtotime($payment->created_at))}}</td>
																<td> @if($payment->payment_status=="captured") 
                                                                      <span>Paid</span>
                                                                    @else
                                                                      <span>{{$payment->payment_status}}</span>
                                                                    @endif
                                                                    </td>
															</tr>
                                                            @endforeach
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				<!--end row-->
       

@endsection
@section('scripts')
<script>
    $(document).ready(function () {      
   $(".CheckPassword").on('keyup', function(){
        var password = $("#Password").val();
        var confirmPassword = $("#ConfirmPassword").val();
        var strength = 1;
        /*length 5 characters or more*/
         if(this.value.length <= 5) {
             strength++; 
             $("#passMatch").html("Password Must be atleast 6 character !").css("color","red");
             $(".btn-submit").prop("disabled", true);
        }else{
            
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
        }
   });
});
  

</script>
@endsection