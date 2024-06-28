@extends('institution.layouts.app')
@section('institution-content')
<style>
    .sidebar{
        float: left;
            width: 30% !important;
            height: 150px !important;
            margin-top: -12px !important;
            border: 1px solid #fff !important;
            padding-right: 30px !important;
            border-radius: 5px !important; 
            box-shadow: 0px 1px 6px 2px #f2f0f0 !important;
    }
    
    .profile-div {
        float: left;
        padding: 5px 12px;
        border: 1px solid #fff;
        background: #fff;
        width: 60%;
        height: 100%;
        margin-left: 40px;
        animation: blinker 0.6s linear;
        border-radius: 5px !important;
        box-shadow: 0px 1px 6px 2px #f2f0f0 !important;
        margin-top: -10px;
    }


</style>
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
							<div class="col-md-3">
								<h4 class="mb-3 mb-md-0">Settings</h4>
							</div>
							<div class="col-md-9">
								
							</div>
						</div>
					</div>
				</div>
				
				
				
				<!--end row-->
				<div class="row row-cols-1">
					<div class="col-12">
						<div class="card radius-10 w-100">
							
							<div class="card-body">
								<div class="tab sidebar">
								    <button class="tablinks @if($master_type =='' || $master_type =='profile-sec') {{'active'}} @endif" onclick="openTab(event, 'coding', 'arrow1')" id="defaultOpen">
								      <i class="fas fa-laptop-code"></i><i class="bx bx-user-circle" style="padding-right: 10px;"></i>
								       Profile
								       <span id="arrow1" class="arrow fas fa-caret-right"></span>
								      </button>
								     
								    <button class="tablinks @if($master_type =='password-sec') {{'active'}} @endif" onclick="openTab(event, 'wordPress', 'arrow2')">
								      <i class="fab fa-wordpress"></i><i class="lni lni-unlock" style="padding-right: 10px;"></i>
								      Change Password <span id="arrow2" class=" arrow fas fa-caret-right"></span>
								    </button>
								    
								</div>
								   
								  <div id="coding" class="tabcontent profile-div" style="@if($master_type =='' || $master_type =='profile-sec') {{'display:block;'}} @endif">
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
								    
									<div class="d-flex align-items-center">
										<div>
											<h5 class="mb-0">User Profile</h5>
										</div>
                                        
										<div class="font-22 ms-auto">
											<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#examplePrimaryModal"><i class="fadeIn animated bx bx-edit-alt" style="margin-right: 10px;"></i>Edit</button>
										</div>
										<!-- Modal -->
																	<div class="modal fade" id="examplePrimaryModal" tabindex="-1" aria-hidden="true">
																		<div class="modal-dialog modal-lg modal-dialog-centered">
																			<div class="modal-content bg-primary">
																				<div class="modal-header">
																					<h5 class="modal-title text-white" style="color: #000000!important;">Edit profile</h5>
																					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																				</div>
																				<div class="modal-body text-white">
																					<form class="row g-3" action="{{route('institution.change.profile')}}" method="post" enctype="multipart/form-data" onsubmit="return Validate(this);">
                                    @csrf
																						<div class="col-md-6">
																							<label class="form-label" style="color: #000000!important;">Profile Image</label>
																							<input type="file"  placeholder="********" class="form-control" name="image" id="image" style="margin-top: 5px;" accept="image/png, image/gif, image/jpeg">
																						</div>
																							<div class="row row-cols-auto g-3">
																								
																								<div class="col">
																									<button type="submit" class="btn btn-primary px-5"><i class="lni lni-circle-plus"></i>Update</button>
																								</div>
																							</div>
																						
																					</form>
																				</div>
																				
																			</div>
																		</div>
																	</div>
										</div>

									
										
											
										<dl class="row">
											<dt class="col-sm-3">Profile Image</dt>
											<dd class="col-sm-9" type="button" data-bs-toggle="modal" data-bs-target="#examplePrimaryModal1">
                                                
                                             @if(!is_null(auth('institution')->user()->image))
												    <img src="{{asset('setting/'.auth('institution')->user()->image)}}" class="rounded-circle p-1 border" width="90" height="90" alt="..." style="border-radius: 0px!important">
                                                @else
                                                    <img src="{{asset('assets/images/avatars/prof.png')}}" class="rounded-circle p-1 border" width="90" height="90" alt="..." style="border-radius: 0px!important">
                                                @endif
                                            
                                            
                                            </dd>
											<div class="modal fade" id="examplePrimaryModal1" tabindex="-1" aria-hidden="true">
																		<div class="modal-dialog modal-lg modal-dialog-centered">
																			<div class="modal-content bg-primary">
																				<div class="modal-header">
																					<h5 class="modal-title text-white" style="color: #000000!important;">Profile Image</h5>
																					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																				</div>
																				<div class="modal-body text-white">
																					<form class="row g-3">
																						
																						<div class="col-md-6">
																							<label for="img" class="form-label" style="color: #000000!important;">Select the Profile image</label>
																							<input type="file" class="form-control" id="inputGroupFile01">
																						</div>
																							
																							<div class="row row-cols-auto g-3">
																								<div class="col">
																									<button type="submit" class="btn btn-primary px-5"><i class="lni lni-cross-circle"></i>Cancel</button>
																								</div>
																								<div class="col">
																									<button type="submit" class="btn btn-primary px-5"><i class="lni lni-circle-plus"></i>Update</button>
																								</div>
																							</div>
																						
																					</form>
																				</div>
																				
																			</div>
																		</div>
																	</div>

											<dt class="col-sm-3">Institution Name</dt>
											<dd class="col-sm-9">{{$institution->institution_name}}</dd>
										  
											<dt class="col-sm-3">Contact Person</dt>
											<dd class="col-sm-9">{{$institution->contact_name}}</dd>
										  
											<dt class="col-sm-3">Designation</dt>
											<dd class="col-sm-9">{{$institution->designation}}</dd>

											<dt class="col-sm-3">Mobile Number</dt>
											<dd class="col-sm-9">{{$institution->phone_number}}</dd>

											<dt class="col-sm-3">email id</dt>
											<dd class="col-sm-9">{{$institution->email}}</dd>
										</dl>
										
									
										
							
								  </div>
								   
								  <div id="wordPress" class="tabcontent profile-div" style="@if($master_type =='password-sec') {{'display:block;'}} @endif">
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
								   <div>
										<h5 class="mb-0">Change Password</h5>
									</div>
                                <form  action="{{route('institution.change.password')}}" method="post">
                                    @csrf
								    <div class="row mb-3">
										<label for="inputEnterYourName" class="col-sm-3 col-form-label">Current Password</label>
										<div class="col-sm-9">
											<input type="password" class="form-control" name="current_password" id="current_password"placeholder="Current Password">
										</div>
									</div>
									
									<div class="row mb-3">
										<label for="inputChoosePassword2" class="col-sm-3 col-form-label">New Password</label>
										<div class="col-sm-9">
											<input type="password" required class="form-control CheckPassword" name="password" id="Password"placeholder="New Password">
										</div>
									</div>
									<div class="row mb-3">
										<label for="inputConfirmPassword2" class="col-sm-3 col-form-label">Verify Password</label>
										<div class="col-sm-9">
											<input type="password" required class="form-control CheckPassword" id="ConfirmPassword" placeholder="Verify Password">
                                             <span style="margin-top: 7px;" id="passMatch"></span>
										</div>
                                        
									</div>
									
									<div class="row">
										
										<div class="row row-cols-auto g-3">
                                            
											<div class="col">
												<a href="{{url('institution/dashboard')}}" class="btn btn-primary px-5"><i class="lni lni-cross-circle"></i>Cancel</a>
											</div>
											<div class="col">
                                                
											<button type="submit" class="btn btn-primary px-5"><i class="lni lni-save"></i>Save</button>
											</div>
										</div>
									</div>
                                
                                </form>
								  </div>
								   
								  
								  <script>
										function openTab(evt, Services, arrows) {
										  var i, tabcontent, tablinks, tabArrow;
										  tabcontent = document.getElementsByClassName("tabcontent");
										  for (i = 0; i < tabcontent.length; i++) {
										    tabcontent[i].style.display = "none";
										  }
										   
										  
										  tablinks = document.getElementsByClassName("tablinks");
										  for (i = 0; i < tablinks.length; i++) {
										    tablinks[i].className = tablinks[i].className.replace(" active", "");
										  }
										   
										  document.getElementById(arrows).style.display = "block";
										  document.getElementById(Services).style.display = "block";
										  evt.currentTarget.className += " active";
										}
										// Get the element with id="defaultOpen" and click on it
										document.getElementById("defaultOpen").click();
									</script>	
										
							</div>
						</div>
					</div>
					
				</div>
				<!--end row-->
				
				
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