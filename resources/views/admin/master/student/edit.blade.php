<div class="modal-header">
   <h5 class="modal-title text-white" style="color: #000000!important;">Update Student</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-white">
   <form class="row g-3" action="{{ route('student.update',$student->id)}}" method="post">
      @csrf
      @method('PUT')
      <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label" style="color: #000000!important;">Student Name</label>
                                                <input type="text" class="form-control" required value="{{$student->fullname}}" name="fullname">
                                             </div>
                                            
                                             <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label" style="color: #000000!important;">Email Id</label>
                                                <input type="email" class="form-control email1" name="email" value="{{$student->email}}" data-value="{{$student->email}}" required>
                                                 <span style="margin-top: 7px;" class="emailMatch1"></span>
                                             </div>
                                             <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Mobile Number</label>
                                                <input type="number" class="form-control mobile" name="phone_number" value="{{$student->phone_number}}" data-value="{{$student->phone_number}}" required pattern="[789][0-9]{9}">
                                                 <span style="margin-top: 7px;" class="mobileMatch11"></span>
                                             </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Password</label>
                                        <input type="number" class="form-control CheckPassword passwod" name="password" >
                                                  <span style="margin-top: 7px;" class="CheckcharPasswordMatch"></span>
                                             </div>
                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Institution Type</label>
                                                <select id="institution_type" required name="institution_type" class="form-select ins_type" style="border: 1px solid #40D4FF;" required>
                                                   <option value="">Choose..</option>
                                                   <option value="yes" @if($institution->is_registered =="yes") {{ "selected='selected'"}} @endif>Registered</option>
                                                   <option value="no" @if($institution->is_registered =="no") {{ "selected='selected'"}} @endif>Un Registered</option>
                                                </select>
                                             </div>

                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Institution Name</label>
                                                <select  name="institution_id" class="form-select institution_id" style="border: 1px solid #40D4FF;" required>
                                                   <option value="">Choose</option>
                                                   @foreach($institution_type as $institution)
                                                   <option value="{{ $institution->id}}"  @if($student->institution_id ==$institution->id) {{ "selected='selected'"}} @endif>{{ $institution->institution_name}}</option>
                                                   @endforeach
                                                </select>
                                             </div>
                                             
                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Course Studying</label>
                                                <select id="inputState" class="form-select course_name" name="course_id" style="border: 1px solid #40D4FF;" required>
                                                   <option value="">Choose...</option>
                                                   @foreach($courses as $course)
                                                    <option value="{{$course->id}}" @if($student->course_id == $course->id) {{ "selected='selected'"}} @endif>{{$course->course_name}}</option>
                                                    @endforeach
                                                </select>
                                             </div>
       
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Batch Year</label>
                                                <input type="number" value="{{$student->batch_year}}" class="form-control mobile" name="batch_year" required=''>
                                             </div>
                                              
                                          
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Studying Year</label>
                                                <select required class="form-select studying_year" name="study_year" style="border: 1px solid #40D4FF;">
                                                  @for ($i=1;$i<=$duration;$i++)
                                                   <option value="{{$i}}" @if($i == $student->study_year){{ "selected='selected'"}} @endif>{{$i}}</option>
                                                @endfor
                                                  
                                                </select>
                                             </div>

       
                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Payment Status</label>
                                                <select id="inputState" class="form-select" name="is_payment_done" style="border: 1px solid #40D4FF;" required>
                                                   <option value="">Choose...</option>
                                                    <option value="yes" @if($student->is_payment_done =="yes") {{ "selected='selected'"}} @endif>Yes</option>
                                                   <option value="no" @if($student->is_payment_done =="no") {{ "selected='selected'"}} @endif>No</option>
                                                </select>
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
                                                <button type="submit" class="btn btn-primary px-5 btn-submit1"><i class="lni lni-circle-plus"></i>Update Student</button>
                                             </div>
   </form>
</div>

<script>
   $(document).ready(function () {
       
          $(document).on("change", ".institution_id", function(event) {           
               var data = {
                   "_token": "{{ csrf_token() }}",
                   institution_id:$(this).val()
               };
               $.ajax({
                   type: "POST",
                   url: "{{ route('admin.get.course-list') }}",
                   data: data,
                   success: function(result) {
                        $(".course_name").html('');
                       var course = $(".course_name");
                       course.append(result);
                   }
               });
           });
       
          
       
               $(document).on("change", ".passing_year", function(event) {           
                   var data = {
                       "_token": "{{ csrf_token() }}",
                       pass_year:$(".passing_year").val(),
                       course_id:$(".course_name").val()
                   };
                   $.ajax({
                       type: "POST",
                       url: "{{ route('admin.get.payment') }}",
                       data: data,
                       success: function(result) {
                           if(result == 0){
                                 $(".fees").val("");
                                $(".no_of_year").val("");
                                $(".subscribelMatch").html("signup not allowed for this year of passing!").css("color","red");
                                $(".btn-submit1").prop("disabled", true);
                            }else{
                              $(".fees").val("");
                              $(".no_of_year").val("");
                              $(".fees").val(result.fees);
                              $(".no_of_year").val(result.year);
                              $(".subscribelMatch").html("").css("color","green");
                              $(".btn-submit1").prop("disabled", false);
                            }                   
                       }
                   });
               });
               
                $(document).on("change", ".course_name", function(event) {   
                  
                   var data = {
                       "_token": "{{ csrf_token() }}",
                       course_id:$(this).val(),
                       institution_id:$(".institution_id").val()
                   };
                   $.ajax({
                       type: "POST",
                       url: "{{ route('admin.get.course-years-list') }}",
                       data: data,
                       success: function(result) {
                            $(".passing_year").html('');
                           var course = $(".passing_year");
                           course.append(result);
                       }
                   });
            });
               
               
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
                   $(".addModelForm_Procedure").modal("show");
               }
           });
       });


   $(document).on("change",".ins_type", function() {
      var ins_type = this.value;
      $("select[name=institution_id]").html('');
       
      $.ajax({
         url: "{{url('admin/get/institution-type')}}",
         type: "POST",
         data: {
         ins_type: ins_type,
         _token: '{{csrf_token()}}'
         },
                    dataType: 'json',
                    success: function (result) {
                        $('select[name=institution_id]').html('<option value="">Choose..</option>');
                        $.each(result.institution_type, function (key, value) {
                            $("select[name=institution_id]").append('<option value="' + value
                                .id + '">' + value.institution_name + '</option>');
                        });
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
               url: "{{ route('admin.check.email') }}",
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
       
         $(document).on("keyup", ".mobile", function(event) {
           if ($(this).val().length !==10) {
                        $(".btn-submit1").prop("disabled", true);
                        $(".mobileMatch11").html("Mobile Number should be 10digit  !").css("color", "red");
                        return false;
          } else {   
           var data = {
               "_token": "{{ csrf_token() }}",
               mobile:$(this).val(),
               exist_value: $(this).data('value'),
           };
               $.ajax({
                   type: "POST",
                   url: "{{ route('admin.check.mobile') }}",
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
          }
       });
       
       
          $(".CheckPassword").on('keyup', function(){
        var password = $(".password").val();
        var strength = 1;
        /*length 5 characters or more*/
        if(this.value.length <= 5) {
             strength++; 
             $(".CheckcharPasswordMatch").html("Password Must be atleast 6 character !").css("color","red");
             $(".btn-submit1").prop("disabled", true);
        }else{
            $(".CheckcharPasswordMatch").html("").css("color","green");
                 $(".btn-submit1").prop("disabled", false);
        }
   });
       
       

   });
    
    
</script>