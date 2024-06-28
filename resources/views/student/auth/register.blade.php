<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!--favicon-->
      <link rel="icon" href="{{ asset('assets/images/Ds/logo.png')}}" type="image/png" />
       
       <style>
@font-face {
    font-family: Gilroy-Bold;
    src: url("asset('assets/fonts/Gilroy-Bold.ttf')") format('truetype');
}
@font-face {
    font-family: Gilroy-SemiBold;
    src: url("{{asset('assets/fonts/Gilroy-SemiBold.ttf')}}") format('truetype');
}
@font-face {
    font-family: Gilroy-Regular;
    src: url("{{asset('assets/fonts/Gilroy-Regular.ttf')}}") format('truetype');
}
@font-face {
    font-family: Gilroy-Thin;
    src: url("{{asset('assets/fonts/Gilroy-Thin.ttf')}}") format('truetype');
}


</style>
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
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
          -webkit-appearance: none;
          margin: 0;
        }

        /* Firefox */
        input[type=number] {
          -moz-appearance: textfield;
           } 
           
           

         
       </style>
   </head>
  <body class="bg-login">
	<!--wrapper-->
	<div class="wrapper">
		<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
			<div class="container-fluid">
				<div class="row row-cols-1 row-cols-lg-2">
                  
					<div class="col" style="background-color: #ffffff; background-image: url({{ asset('assets/images/Ds/signin.png')}}); background-repeat: no-repeat; background-position: bottom left;">
						<div style="margin-left: 50px;margin-top: 80px;">
							<img src="{{ asset('assets/images/Ds/logo.png')}}" width="250" alt="" />
						</div>
					</div>
         
					<div class="col">
						
				<form action="{{ route('student.register')}}" method="post">
                    @csrf
                  <div class="col">
                     <div class="text-center">
                        <h3 class="" style="text-align: left; font-size: 32px; font-family: Gilroy-SemiBold; padding-left: 24px;margin-top:70px;">Sign Up</h3>
                     </div>
                     <div class="text-center">
                        <h3 class="" style="text-align: left; font-size: 24px; font-family: Gilroy-SemiBold; padding-left: 24px; padding-top: 10px;">Basic Information</h3>
                     </div>
                      @if (Session::has('error'))
                                <div class="alert alert-danger">
                                    <div>
                                        <p>{{ Session::get('error') }}</p>
                                    </div>
                                </div>
                            @endif
                     <div class="row row-cols-1 row-cols-lg-2" style="display: flex; margin-top: -20px; margin-bottom: -20px;!important">
                        <div class="col">
                          
                           <div class="card-1" style="box-shadow: ; padding: 0px 10px 0px 0px !important">
                              <div class="card-body">
                                 <div class="border p-4 rounded" style="border:none!important;">
                                    <div class="form-body row g-3">
                                      
                                          <div class="col-12">
                                             <label for="inputEmailAddress" class="form-label" style="text-align: left; font-size: 18px; font-family: Gilroy-Medium">Name</label>
                                             <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Name" autocomplete="off" required>
                                          </div>
                                          <div class="col-12">
                                             <label for="inputEmailAddress" class="form-label" style="text-align: left; font-size: 18px; font-family: Gilroy-Medium">Mobile No.</label>
                                             <input type="number"  required autocomplete="off" class="form-control mobile" name="phone_number"  pattern="[6-9]{1}[0-9]{9}" autocomplete="off"  placeholder="Mobile Number">
                                             <span style="margin-top: 7px;" id="mobileMatch"></span>
                                          </div>
                                          <div class="col-12">
                                             <label for="inputChoosePassword" class="form-label" style="text-align: left; font-size: 18px; font-family: Gilroy-Medium">Password</label>
                                             <div class="input-group" id="show_hide_password">
                                                <input type="password"  required class="form-control CheckPassword" name="password"   autocomplete="off" id="Password" placeholder="Enter Password"> 
                                             </div>
                                              <span style="margin-top: 7px;" id="CheckcharPasswordMatch"></span>
                                          </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="card-1" style="box-shadow: ; padding: 0px 10px 0px 0px !important">
                              <div class="card-body">
                                 <div class="border p-4 rounded" style="border:none!important;">
                                    <div class="form-body row g-3">
                                          <div class="col-12">
                                             <label for="inputEmailAddress" class="form-label" style="text-align: left; font-size: 18px; font-family: Gilroy-Medium">Email Id.</label>
                                             <input type="email" class="form-control email" name="email"  required placeholder="email">
                                              <span style="margin-top: 7px;" id="emailMatch"></span>
                                          </div>
                                            
                                          <div class="col-12">
                                             <label for="inputEmailAddress" class="form-label" style="text-align: left; font-size: 18px; font-family: Gilroy-Medium">Date of Birth</label>
                                             <input type="date" class="form-control dob"name="dob" max="{{date('Y-m-d')}}" required placeholder="00-00-0000">
                                          </div>
                                          <div class="col-12">
                                             <label for="inputChoosePassword" class="form-label" style="text-align: left; font-size: 18px; font-family: Gilroy-Medium">Confirm Password</label>
                                             <div class="input-group" id="show_hide_password">
                                                <input type="password" required name="confirm_password" class="form-control  CheckPassword" id="ConfirmPassword"  placeholder="Confirm Password"> 
                                             </div>
                                               <span style="margin-top: 7px;" id="CheckPasswordMatch"></span>
                                          </div>
                                         
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="text-center" style="margin-top: -20px; margin-bottom: -20px;!important">
                        <h3 class="" style="text-align: left; font-size: 24px; font-family: Gilroy-SemiBold; padding-left: 30px;">Education Information</h3>
                        <br><br>
                     </div>
                     <div class="col" style="margin: 0px 30px 0px 30px !important;">
                        <label class="form-label" style="text-align: left; font-size: 18px; font-family: Gilroy-Medium">
                           <h6 >Institution Name</h6>
                        </label>
                        <select class="form-select form-select-sm institution_id" required name="institution_id">
                           <option>Choose</option>
                           @foreach($institutions as $institution)
                           <option value="{{$institution->id}}">{{$institution->institution_name}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="row row-cols-1 row-cols-lg-2" style="display: flex;">
                        <div class="col">
                           <div class="card-1" style="box-shadow: ; padding: 0px 10px 0px 0px !important">
                              <div class="card-body">
                                 <div class="border p-4 rounded" style="border:none!important;">
                                    <div class="form-body">
                                          <div class="col" style="margin-left: 5px !important;">
                                             <label class="form-label" style="text-align: left; font-size: 18px; font-family: Gilroy-Medium">
                                                <h6>Offered Course</h6>
                                             </label>
                                             <select class="form-select form-select-sm course_name" name="course_id" required>
                                                    <option>Choose</option>
                                                  
                                             </select>
                                          </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col">
                           <div class="card-1" style="box-shadow: ; padding: 0px 10px 0px 0px !important">
                              <div class="card-body">
                                  <input class="fees" type="hidden" name="fees" >
                                  <input type="hidden" class="no_of_year" name="year_level">
                                         <div class="border p-4 rounded" style="border:none!important;">
                                            <div class="form-body">
                                            <div class="col" style="margin-left: 5px !important;">
                                              
                                             <label class="form-label">
                                                <h6>Batch Year</h6>
                                             </label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="number" required pattern="[0-9]{4}"  name="batch_year" class="form-control" max="{{date('Y')}}" placeholder="Ex: {{date('Y')}}"> 
                                             </div>

                                          </div>
                                                 </div>
                                              </div>
                              </div>
                           </div>
                         </div>
                         
                       
                     </div>
                       <div class="row row-cols-1 row-cols-lg-2" style="display: flex;">
                              <div class="col">
                           <div class="card-1" style="box-shadow: ; padding: 0px 10px 0px 0px !important;margin-top: -50px;">
                              <div class="card-body">
                                         <div class="border p-4 rounded" style="border:none!important;">
                                            <div class="form-body">
                                            <div class="col" style="margin-left: 5px !important;">
                                             <label class="form-label">
                                                <h6>Studying Year</h6>
                                             </label>
                                            <div class="input-group" id="show_hide_password">
                                               <select required class="form-select studying_year" name="study_year" style="border: 1px solid #40D4FF;">
                                                   <option value="">Choose...</option>
                                                  
                                                </select>
                                             </div>

                                          </div>
                                                 </div>
                                              </div>
                              </div>
                           </div>
                        </div>
                      </div>
                       <div class="col-md-6">
                           <div class="form-check form-switch" style="padding-left: 30px">
                              <input type="checkbox" value="lsRememberMe" required id="rememberMe"> 
                               <label for="rememberMe" style="text-align: left; font-size: 14px; font-family: Gilroy-Regular">Accept Terms and Conditions </label>
                           </div>
                        </div>
                        
                     <div class="d-grid" style="padding: 0px 30px 0px 30px !important;">
                        <button type="submit" class="btn btn-primary btn-submit" style="text-align: center; font-size: 20px; font-family: Gilroy-SemiBold">Create an account</button>
                     </div>
                      
                  </div>
                </form>
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
            
            
              $(document).on("keyup", ".mobile", function(event) {
             if ($(this).val().length !==10) {
                        $(".btn-submit").prop("disabled", true);
                        $("#mobileMatch").html("Mobile Number should be 10digit  ").css("color", "red");
                        return false;
              } else {  
                   var data = {
                      "_token": "{{ csrf_token() }}",
                      mobile: $(this).val()
                   };
                   $.ajax({
                      type: "POST",
                      url: "{{ route('student.check.mobile') }}",
                      data: data,
                      success: function(result) {
                         if (result == "true") {
                            $(".btn-submit").prop("disabled", true);
                            $("#mobileMatch").html("Mobile Number already Exist !").css("color", "red");
                         } else {
                            $("#mobileMatch").html("").css("color", "green");
                            $(".btn-submit").prop("disabled", false);
                         }
                      }
                   });
              }
            });
            
            
		});
        
     $(document).ready(function() {
       $(document).on("change", ".passing_year", function(event) {           
           var data = {
               "_token": "{{ csrf_token() }}",
               pass_year:$(".passing_year").val(),
               course_id:$(".course_name").val()
           };
           $.ajax({
               type: "POST",
               url: "{{ route('student.get.payment') }}",
               data: data,
               success: function(result) {
                   if(result == 0){
                         $(".fees").val("");
                        $(".no_of_year").val("");
                        $("#subscribelMatch").html("signup not allowed for this year of passing!").css("color","red");
                        $(".btn-submit").prop("disabled", true);
                    }else{
                      $(".fees").val("");
                      $(".no_of_year").val("");
                      $(".fees").val(result.fees);
                      $(".no_of_year").val(result.year);
                      $("#subscribelMatch").html("").css("color","green");
                      $(".btn-submit").prop("disabled", false);
                    }                   
               }
           });
       });
        //check email
        $(document).on("keyup", ".email", function(event) {
           var data = {
               "_token": "{{ csrf_token() }}",
               email:$(this).val()
           };
           $.ajax({
               type: "POST",
               url: "{{ route('student.check.email') }}",
               data: data,
               success: function(result) {
                   if(result == "true"){
                       $(".btn-submit").prop("disabled", true);
                       $("#emailMatch").html("Email already Exist !").css("color","red");
                    }else{
                       $("#emailMatch").html("").css("color","green");
                       $(".btn-submit").prop("disabled", false);
                    }
               }
           });
       });
         
         
    });
        
        
        
   $(".CheckPassword").on('keyup', function(){
        var password = $("#Password").val();
        var confirmPassword = $("#ConfirmPassword").val();
        
        var strength = 1;
        /*length 5 characters or more*/
        if(this.value.length <= 5) {
             strength++; 
             $("#CheckcharPasswordMatch").html("Password Must be atleast 6 character !").css("color","red");
             $(".btn-submit").prop("disabled", true);
        }else{
             $("#CheckcharPasswordMatch").html("");
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
        
        $(document).on("change", ".institution_id", function(event) {           
           var data = {
               "_token": "{{ csrf_token() }}",
               institution_id:$(".institution_id").val()
           };
           $.ajax({
               type: "POST",
               url: "{{ route('student.get.course-list') }}",
               data: data,
               success: function(result) {
                    $(".course_name").html('');
                   var course = $(".course_name");
                   course.append(result);
               }
           });
       });
        
        $(document).on("change", ".course_name", function(event) {           
           var data = {
               "_token": "{{ csrf_token() }}",
               course_id:$(".course_name").val(),
               institution_id:$(".institution_id").val()
           };
           $.ajax({
               type: "POST",
               url: "{{ route('student.get.course-years-list') }}",
               data: data,
               success: function(result) {
                    $(".studying_year").html('');
                   var course = $(".studying_year");
                   course.append(result);
               }
           });
       });
        
</script>
	<!--app JS-->
	<script src="{{ asset('assets/js/app.js')}}"></script>
</body>
</html>