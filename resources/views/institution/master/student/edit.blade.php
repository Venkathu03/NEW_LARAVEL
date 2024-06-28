<div class="modal-header">
   <h5 class="modal-title text-white" style="color: #000000!important;">Update Student</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-white">
   <form class="row g-3" action="{{ route('institution-student.update',$student->id)}}" method="post">
      @csrf
      @method('PUT')
      <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label" style="color: #000000!important;">Students Name</label>
                                                <input type="text" class="form-control" value="{{$student->fullname}}" name="fullname">
                                             </div>
                                           
                                           <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label" style="color: #000000!important;">Email Id</label>
                                                <input type="email" class="form-control email1" name="email" value="{{$student->email}}" data-value="{{$student->email}}" required>
                                                 <span style="margin-top: 7px;" class="emailMatch1"></span>
                                             </div>
                                            
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Password</label>
                                                <input type="number" class="form-control CheckPassword1" id="passwod1" name="password" >
                                                  <span style="margin-top: 7px;" class="CheckcharPasswordMatch1"></span>
                                             </div>
       
                                          <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Mobile Number</label>
                                                <input type="number" class="form-control mobile1" name="phone_number" value="{{$student->phone_number}}" data-value="{{$student->phone_number}}" required required='' pattern="[6-9]{1}[0-9]{9}">
                                                 <span style="margin-top: 7px;" class="mobileMatch11"></span>
                                             </div>
                                             
                                             
                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Course Studying</label>
                                                <select  class="form-select course_name" name="course_name_one" style="border: 1px solid #40D4FF;"  id="course_name_one" required>
                                                   <option>Choose...</option>
                                                   @foreach($courses as $course)
                                                    <option value="{{$course->id}}" @if($student->course_name == $course->id) {{ "selected='selected'"}} @endif>{{$course->course_name}}</option>
                                                    @endforeach
                                                </select>
                                             </div>
                                                <div class="col-md-6">
                                                   <label class="form-label" style="color: #000000;">Passing Year
                                                     </label>
                                                     <select class="form-select form-select-sm passing_year" name="passing_year" required>
                                                           <option value="{{$student->passing_year}}" selected>{{$student->passing_year}}</option>
                                                     </select>
                                                     <span style="margin-top: 7px;" class="subscribelMatch"></span>
                                                     <input type="hidden" class="no_of_year" name="year_level">
                                              </div>
                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Active Status</label>
                                                <select id="inputState" class="form-select" name="active_status" style="border: 1px solid #40D4FF;" required>
                                                   <option value="">Choose...</option>
                                                    <option value="1" @if($student->active_status =="1") {{ "selected='selected'"}} @endif>Active</option>
                                                   <option value="2" @if($student->active_status =="2") {{ "selected='selected'"}} @endif>Inactive</option>
                                                </select>
                                             </div>
       
                                             <div class="col-12">
                                                <button type="submit" class="btn btn-primary px-5 btn-submit1"><i class="lni lni-circle-plus"></i>Update</button>
                                             </div>
   </form>
</div>


<script>
   $(document).ready(function () {
       $(document).on("click", ".edit_detail", function(event) {
           var userURL =$(this).data("url");
           var data = {
               "_token": "{{ csrf_token() }}",
   			 id:$(this).data("value")
           };
           $.ajax({
               type: "POST",
               url: userURL,
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                   $("#addModelForm_Procedure1").modal("show");
               }
           });
       });


   $(".ins_type").on("change", function() {
      var ins_type = this.value;
      $("#institution_id").html('');

      $.ajax({
         url: "{{url('institution/get/institution-type')}}",
         type: "POST",
         data: {
         ins_type: ins_type,
         _token: '{{csrf_token()}}'
         },
                    dataType: 'json',
                    success: function (result) {
                        $('#institution_id').html('<option value="">Choose..</option>');
                        $.each(result.institution_type, function (key, value) {
                            $("#institution_id").append('<option value="' + value
                                .id + '">' + value.institution_name + '</option>');
                        });
                    }
                });
    });
       
         $(document).on("change", ".passing_year1", function(event) {           
                   var data = {
                       "_token": "{{ csrf_token() }}",
                       pass_year:$(this).val(),
                       course_id:$("#course_name_one").val()
                   };
                   $.ajax({
                       type: "POST",
                       url: "{{ route('institution.get.payment') }}",
                       data: data,
                       success: function(result) {
                           if(result == 0){
                                 $(".fees").val("");
                                $(".no_of_year").val("");
                                $(".subscribelMatch1").html("signup not allowed for this year of passing!").css("color","red");
                                $(".btn-submit1").prop("disabled", true);
                            }else{
                              $(".fees").val("");
                              $(".no_of_year").val("");
                              $(".fees").val(result.fees);
                              $(".no_of_year").val(result.year);
                              $(".subscribelMatch1").html("").css("color","green");
                              $(".btn-submit1").prop("disabled", false);
                            }                   
                       }
                   });
               });
               
                $(document).on("change", "#course_name_one", function(event) {   
                $(this).attr("selected","selected");
                     var course_id=$(this).val();
                    $("select option[value="+course_id+"]").attr("selected","selected");
                   var data = {
                       "_token": "{{ csrf_token() }}",
                       course_id:$(this).val()
                   };
                   $.ajax({
                       type: "POST",
                       url: "{{ route('institution.get.course-years-list') }}",
                       data: data,
                       success: function(result) {
                            $(".passing_year1").html('');
                        
                           var course = $(".passing_year1");
                           course.append(result);
                       }
                   });
            });
       
         $(document).on("keyup", ".email1", function(event) {
           var data = {
               "_token": "{{ csrf_token() }}",
               email:$(this).val(),
               exist_value: $(this).data('value'),
           };
           $.ajax({
               type: "POST",
               url: "{{ route('institution.check.email') }}",
               data: data,
               success: function(result) {
                   if(result == "true"){
                       $(".btn-submit1").prop("disabled", true);
                       $(".emailMatch1").html("Email already Exist !").css("color","red");
                    }else{
                       $(".emailMatch1").html("").css("color","green");
                       $(".btn-submit1").prop("disabled", false);
                    }
               }
           });
       });
       
         $(document).on("keyup", ".mobile1", function(event) {
            
           var data = {
               "_token": "{{ csrf_token() }}",
               mobile:$(this).val(),
               exist_value: $(this).data('value'),
           };
           $.ajax({
               type: "POST",
               url: "{{ route('institution.check.mobile') }}",
               data: data,
               success: function(result) {
                   if(result == "true"){
                       $(".btn-submit1").prop("disabled", true);
                       $(".mobileMatch11").html("Mobile Number already Exist !").css("color","red");
                    }else{
                       $(".mobileMatch11").html("").css("color","green");
                       $(".btn-submit1").prop("disabled", false);
                    }
               }
           });
       });
       
        $(".CheckPassword1").on('keyup', function(){
        var password = $("#password1").val();
        var strength = 1;
           if(this.value.length == 0) {
               $(".CheckcharPasswordMatch1").html("").css("color","green");
                $(".btn-submit1").prop("disabled", false);
           }
         else if(this.value.length <= 5) {
             strength++; 
             $(".CheckcharPasswordMatch1").html("Password Must be atleast 6 character !").css("color","red");
             $(".btn-submit1").prop("disabled", true);
        }else{
            $(".CheckcharPasswordMatch1").html("").css("color","green");
             $(".btn-submit1").prop("disabled", false);
        }
   });

   });
</script>