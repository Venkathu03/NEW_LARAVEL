@extends('institution.layouts.app')
@section('institution-content')
<div class="card shadow-none bg-transparent border-bottom border-2">
   <div class="card-body">
      <div class="row align-items-center">
         <div class="col-md-12">
            <h4 class="mb-3 mb-md-0">Student Management</h4>
         </div>
         
      </div>
   </div>
</div>
<div class="col">
  <div class="tab-content py-3">
      <div class="tab-pane fade show active" id="primaryprofile" role="tabpanel">
         <div class="row row-cols-1">
            <div class="col d-flex">
               <div class="card radius-10 w-100" style="margin-bottom: 0px;">
                  <div class="card-body">
                     <div class="d-flex align-items-center">
                        <div class="g-33" style="align-items: center;">
                           <div class="col1">
                              <h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Students Details</h5>
                           </div>
                           <div class="col1" style="margin-top: 0px">
<!--                              <button type="button" class="btn btn-primary create_student" style="float: right;"><i class="lni lni-circle-plus"></i>Create Student</button>-->
                              <!-- Modal -->
                              <div class="modal fade" id="examplePrimaryModal1" tabindex="-1" aria-hidden="true">
                                 <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content bg-primary">
                                      
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
               </div>
            </div>
         </div>
         <div class="card">
                 @include('institution.layouts.messages')
            <div class="card-body">
               <div class="table-responsive">
                 <table id="example" class="table table-striped table-bordered">
					<thead style="background-color: #E4E4E4;">
                        <tr>
                           <th>S.No.</th>
                            <th>Student Name</th>
                            <th>Email id</th>
                           <th>Mobile Number</th>
                           <th>Course Studying</th>
                            <th>Enrollment Year</th>
                            <th>Studying Year</th>
                            <th> Batch Year </th>
                           <th>Payment Status</th>
                            <th>Active Status</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($students as $key=>$student)
                        <tr>
                           <td>{{$key+1}}</td>
                            <td>{{$student->fullname}}</td>
                           <td>{{$student->email}}</td>
                           <td>{{$student->phone_number}}</td>
                           <td>{{!is_null($student->course) ?$student->course->course_name:""}}</td>
                           <td>{{$student->enrollment_year}} / {{$student->year_level}}</td>
                            <td>{{$student->year_level}}</td>
                            <td> {{$student->batch_year}}</td>
                           <td>{{$student->is_payment_done}}</td>
                             <td>@if($student->active_status == 1) <span class="text-success">Active</span>
                                   @else 
                                   <span class="text-danger">Inactive</span>
                                   @endif</td>
                           <td>
                               <!--  <a href="#" style="text-decoration: underline; color: #000000;"  class="edit_detail" data-value="{{$student->id}}" >Edit</a>-->
                               <a href="{{ route('institution.report.student', $student->id) }}"  style="text-decoration: underline; color: #000000;" >Report</a></td>
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
<!--end row-->
<div class="modal fade addModelForm_Procedure" id="addModelForm_Procedure" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content bg-primary">
      </div>
   </div>
</div>
@endsection
@section('scripts')


<script>
    
   $(document).ready(function () {
       
           $(document).on("click", ".create_student", function(event) {
           var data = {
               "_token": "{{ csrf_token() }}",
   			    id:$(this).data("value")
           };
           $.ajax({
               type: "POST",
               url: "{{ url('institution/student/create')}}",
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                   $("#addModelForm_Procedure").modal("show");
               }
           });
       });
       
       
       
       $(document).on("change", ".passing_year1", function(event) {           
                   var data = {
                       "_token": "{{ csrf_token() }}",
                       pass_year:$(this).val(),
                       course_id:$("#course_name1").val()
                   };
                   $.ajax({
                       type: "POST",
                       url: "{{ route('institution.get.payment') }}",
                       data: data,
                       success: function(result) {
                           if(result == 0){
                                 $(".fees").val("");
                                $(".no_of_year").val("");
                                $(".subscribelMatch").html("signup not allowed for this year of passing!").css("color","red");
                                $(".btn-submit").prop("disabled", true);
                            }else{
                              $(".fees").val("");
                              $(".no_of_year").val("");
                              $(".fees").val(result.fees);
                              $(".no_of_year").val(result.year);
                              $(".subscribelMatch").html("").css("color","green");
                              $(".btn-submit").prop("disabled", false);
                            }                   
                       }
                   });
               });
       
        $(document).on("change", ".passing_year", function(event) {  
                   var data = {
                       "_token": "{{ csrf_token() }}",
                       pass_year:$(this).val(),
                       course_id:$(".course_name").val()
                   };
                   $.ajax({
                       type: "POST",
                       url: "{{ route('institution.get.payment') }}",
                       data: data,
                       success: function(result) {
                           if(result == 0){
                                 $(".fees").val("");
                                $(".no_of_year").val("");
                                $(".subscribelMatch").html("signup not allowed for this year of passing!").css("color","red");
                                $(".btn-submit").prop("disabled", true);
                            }else{
                              $(".fees").val("");
                              $(".no_of_year").val("");
                              $(".fees").val(result.fees);
                              $(".no_of_year").val(result.year);
                              $(".subscribelMatch").html("").css("color","green");
                              $(".btn-submit").prop("disabled", false);
                            }                   
                       }
                   });
               });
               
        //passing year
                $(document).on("change", ".course_name1", function(event) {  
                    $(".course_name1 option[value="+$(this).val()+"]").attr("selected","selected");
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
       
        $(document).on("change", ".course_name", function(event) {  
                    $(".course_name option[value="+$(this).val()+"]").attr("selected","selected");
                   var data = {
                       "_token": "{{ csrf_token() }}",
                       course_id:$(this).val()
                   };
                   $.ajax({
                       type: "POST",
                       url: "{{ route('institution.get.course-years-list') }}",
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
               url: "{{ url('institution/edit/student')}}",
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                   $(".addModelForm_Procedure").modal("show");
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
       
        $(document).on("keyup", ".email", function(event) {
            
           var data = {
               "_token": "{{ csrf_token() }}",
               email:$(this).val()
           };
           $.ajax({
               type: "POST",
               url: "{{ route('institution.check.email') }}",
               data: data,
               success: function(result) {
                   if(result == "true"){
                       $(".btn-submit").prop("disabled", true);
                       $(".emailMatch").html("Email already Exist !").css("color","red");
                    }else{
                       $(".emailMatch").html("").css("color","green");
                       $(".btn-submit").prop("disabled", false);
                    }
               }
           });
       });
       
         $(document).on("keyup", ".mobile", function(event) {
            
           var data = {
               "_token": "{{ csrf_token() }}",
               mobile:$(this).val()
           };
           $.ajax({
               type: "POST",
               url: "{{ route('institution.check.mobile') }}",
               data: data,
               success: function(result) {
                   if(result == "true"){
                       $(".btn-submit").prop("disabled", true);
                       $(".mobileMatch").html("Mobile Number already Exist !").css("color","red");
                    }else{
                       $(".mobileMatch").html("").css("color","green");
                       $(".btn-submit").prop("disabled", false);
                    }
               }
           });
       });
       
       
          $(".CheckPassword").on('keyup', function(){
        var password = $("#password").val();
        var strength = 1;
        /*length 5 characters or more*/
        if(this.value.length <= 5) {
             strength++; 
             $("#CheckcharPasswordMatch").html("Password Must be atleast 6 character !").css("color","red");
             $(".btn-submit").prop("disabled", true);
        }else{
            $("#CheckcharPasswordMatch").html("").css("color","green");
                 $(".btn-submit").prop("disabled", false);
        }
   });
       

   });
</script>
@endsection