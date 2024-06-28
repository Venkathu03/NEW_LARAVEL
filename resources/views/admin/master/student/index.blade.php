@extends('admin.layouts.app')
@section('admin-content')
<!-- <script src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js" defer="defer"></script> -->

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
   <div class="card">
      <div class="card-body">
         <ul class="nav nav-tabs nav-primary" role="tablist">
            <li class="nav-item" role="presentation">
               <a class="nav-link active" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="true">
                  <div class="d-flex align-items-center">
                     <div class="tab-title">Registered Student</div>
                  </div>
               </a>
            </li>
            <li class="nav-item" role="presentation">
               <a class="nav-link" data-bs-toggle="tab" href="#primarychange" role="tab" aria-selected="false">
                  <div class="d-flex align-items-center">
                     <div class="tab-title">UnRegistered Student</div>
                  </div>
               </a>
            </li>

         </ul>

         <div class="tab-content py-3">
            <div class="tab-pane fade show active" id="primaryprofile" role="tabpanel">
               <div class="row row-cols-1">
                  <div class="col d-flex">
                     <div class="card radius-10 w-100" style="margin-bottom: 0px;">
                        @include('admin.layouts.messages')
                        <div class="card-body">

                           <div class="d-flex align-items-center">
                              <div class="g-33" style="align-items: center;">
                                 <div class="col1">
                                    <h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Students Details</h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary create_student"  data-register-type="yes" style="float: right;"><i class="lni lni-circle-plus"></i>Create Student</button>
                                    <!-- Modal -->
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-sm-4">
                                 <label>Filter By Institution</label>
                                 <select class="form-select" id="select_registered_institution">
                                    <option value="">Choose</option>
                                    @foreach($institution_registered as $key=>$institution)
                                    <option value="{{$institution->id}}">{{$institution->institution_name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-sm-4 mt-4">
                                 <button class="btn btn-primary" id="filter_institution_registered">Search</button>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="card-body">
                     <div class="table-responsive">
                     <table id="register_student_table" class="table table-striped table-bordered" style="width:100%">
                     
                     
                     <thead style="background-color: #E4E4E4;">
            <tr>
                <th>S.NO.</th>
                <th>Student Name</th>
                <th>Institution Name</th>
                <th>Institution Type</th>
                <th>Course Name</th>
                <th>Year of Studying</th>
                <th>Enrollment Year</th>
                <th>Mobile Number</th>
                <th>Email id</th>
                <th>Payment Status</th>
                <th>Active Status</th>
                <th>Action</th>

                
                
            </tr>
        </thead>
       
    </table>
                     </div>
                  </div>
               </div>
            </div>

            <div class="tab-pane fade" id="primarychange" role="tabpanel">
               <div class="row row-cols-1">
                  <div class="col d-flex">
                     <div class="card radius-10 w-100" style="margin-bottom: 0px;">
                        @include('admin.layouts.messages')
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="g-33" style="align-items: center;">
                                 <div class="col1">
                                    <h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Students Details</h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary create_student"  data-register-type="no" style="float: right;"><i class="lni lni-circle-plus"></i>Create Student1</button>
                                    <!-- Modal -->
                                 </div>
                              </div>
                           </div>

                           <div class="row">
                              <div class="col-sm-4">
                                 <label>Filter By Institution</label>
                                 <select class="form-select" id="select_unregistered_institution">
                                    <option value="">Choose</option>
                                    @foreach($institution_unregistered as $key=>$institution)
                                    <option value="{{$institution->id}}">{{$institution->institution_name}}</option>
                                    @endforeach
                                 </select>
                              </div>
                              <div class="col-sm-4 mt-4">
                                 <button class="btn btn-primary" id="filter_institution_unregistered">Search</button>
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="card-body">
                     <div class="table-responsive">
                     <table id="unregister_student_table" class="table table-striped table-bordered" style="width:100%">
                     
                     
                     <thead style="background-color: #E4E4E4;">
                         <tr>
                             <th>S.NO.</th>
                             <th>Student Name</th>
                             <th>Institution Name</th>
                             <th>Institution Type</th>
                             <th>Course Name</th>
                             <th>Year of Studying</th>
                             <th>Enrollment Year</th>
                             <th>Mobile Number</th>
                             <th>Email id</th>
                             <th>Payment Status</th>
                             <th>Active Status</th>
                             <th>Action</th>
                             
                         </tr>
                     </thead>
                    
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
         $(document).ready(function() {




            $(document).on("click", ".create_student", function(event) {
               var data = {
                  "_token": "{{ csrf_token() }}",
                  id: $(this).data("value"),
                   register_type: $(this).data("register-type"),
               };
               $.ajax({
                  type: "POST",
                  url: "{{ url('admin/student/create')}}",
                  data: data,
                  success: function(result) {
                     $(".modal-content").empty();
                     $(".modal-content").append(result);
                     $("#addModelForm_Procedure").modal("show");
                  }
               });
            });


            $(document).on("change", ".passing_year", function(event) {
               var data = {
                  "_token": "{{ csrf_token() }}",
                  pass_year: $(".passing_year").val(),
                  course_id: $(".course_name").val()
               };
               $.ajax({
                  type: "POST",
                  url: "{{ route('admin.get.payment') }}",
                  data: data,
                  success: function(result) {
                     if (result == 0) {
                        $(".fees").val("");
                        $(".no_of_year").val("");
                        $("#subscribelMatch").html("signup not allowed for this year of passing!").css("color", "red");
                        $(".btn-submit").prop("disabled", true);
                     } else {
                        $(".fees").val("");
                        $(".no_of_year").val("");
                        $(".fees").val(result.fees);
                        $(".no_of_year").val(result.year);
                        $("#subscribelMatch").html("").css("color", "green");
                        $(".btn-submit").prop("disabled", false);
                     }
                  }
               });
            });

            //passing year
            $(document).on("change", ".course_name", function(event) {
               var data = {
                  "_token": "{{ csrf_token() }}",
                  course_id: $(".course_name").val(),
                  institution_id: $(".institution_id").val()
               };
               $.ajax({
                  type: "POST",
                  url: "{{ route('admin.get.course-years-list') }}",
                  data: data,
                  success: function(result) {
                     $(".studying_year").html('');
                     var course = $(".studying_year");
                     course.append(result);
                  }
               });
            });


            $(document).on("click", ".edit_detail", function(event) {
               var userURL = $(this).data("url");
               var data = {
                  "_token": "{{ csrf_token() }}",
                  id: $(this).data("value")
               };
               $.ajax({
                  type: "POST",
                  url: "{{ url('admin/edit/student')}}",
                  data: data,
                  success: function(result) {
                     $(".modal-content").empty();
                     $(".modal-content").append(result);
                     $("#addModelForm_Procedure").modal("show");
                  }
               });
            });


            $(".ins_type").on("change", function() {
               var ins_type = this.value;
               $("#institution_id").html('');

               $.ajax({
                  url: "{{url('admin/get/institution-type')}}",
                  type: "POST",
                  data: {
                     ins_type: ins_type,
                     _token: '{{csrf_token()}}'
                  },
                  dataType: 'json',
                  success: function(result) {
                     $('#institution_id').html('<option value="">Choose..</option>');
                     $.each(result.institution_type, function(key, value) {
                        $("#institution_id").append('<option value="' + value
                           .id + '">' + value.institution_name + '</option>');
                     });
                  }
               });
            });

            //check email 
            //check email
            $(document).on("keyup", ".email", function(event) {

               var data = {
                  "_token": "{{ csrf_token() }}",
                  email: $(this).val()
               };
               $.ajax({
                  type: "POST",
                  url: "{{ route('admin.check.email') }}",
                  data: data,
                  success: function(result) {
                     if (result == "true") {
                        $(".btn-submit").prop("disabled", true);
                        $("#emailMatch").html("Email already Exist !").css("color", "red");
                     } else {
                        $("#emailMatch").html("").css("color", "green");
                        $(".btn-submit").prop("disabled", false);
                     }
                  }
               });
            });

            $(document).on("keyup", ".mobile", function(event) {
                 if ($(this).val().length !==10) {
                                $(".btn-submit").prop("disabled", true);
                                $("#mobileMatch").html("Mobile Number should be 10digit  !").css("color", "red");
                                return false;
                  } else {  
                       var data = {
                          "_token": "{{ csrf_token() }}",
                          mobile: $(this).val()
                       };
                       $.ajax({
                          type: "POST",
                          url: "{{ route('admin.check.mobile') }}",
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


            $(".CheckPassword").on('keyup', function() {
               var password = $("#password").val();
               var strength = 1;
               /*length 5 characters or more*/
               if (this.value.length <= 5) {
                  strength++;
                  $("#CheckcharPasswordMatch").html("Password Must be atleast 6 character !").css("color", "red");
                  $(".btn-submit").prop("disabled", true);
               } else {
                  $("#CheckcharPasswordMatch").html("").css("color", "green");
                  $(".btn-submit").prop("disabled", false);
               }
            });









         });
      </script>
      <script>

$(document).ready(function() {

var register_student_table = $('#register_student_table').DataTable( {
   ajax: '/admin/getregistered-student',
    columns: [
      {data: 'id'},
        { data: 'fullname' },
        { data: 'institution_name' },
        {data: 'is_registered'},
        { data: 'course' },
        { data: 'study_year' },
        { data: 'enrollment_year' },
        { data: 'phone_number' },
        { data: 'email' },
        { data: 'is_payment_done' },
        {
         
    data: 'active_status',
    render: function (data) {
        if (data === 1) {
            return '<span style="color: green;">Active</span>';
        } else {
            return '<span style="color: red;">Inactive</span>';
        } 
    }
   },


        { data: 'action'},
       
    ]
} );


var unregister_student_table = $('#unregister_student_table').DataTable( {
   ajax: '/admin/getunregistered-student',
    columns: [
      { data: 'id'},
        { data: 'fullname' },
        { data: 'institution_name' },
        {data: 'is_registered'},
        { data: 'course' },
        { data: 'study_year' },
        { data: 'enrollment_year' },
        { data: 'phone_number' },
        { data: 'email' },
        { data: 'is_payment_done' },
        {
    data: 'active_status',
    render: function (data) {
        if (data === 1) {
            return '<span style="color: green;">Active</span>';
        } else  {
            return '<span style="color: red;">Inactive</span>';
        }
    }
},
        { data: 'action'},
       
    ]
} );



$(document).on("click", "#filter_institution_registered", function(event) {

   $.ajax({
                url:"/admin/getregistered-student?institution_id=" + $("#select_registered_institution").val(),
                type: "GET",
                datatype: "json",
                contentType: "application/json; charset=utf-8",
                success: function (json) {

                    $('#register_student_table').DataTable().clear().draw();
                    $('#register_student_table').DataTable().rows.add(json.data).draw();; // Add new data

                },
                error: function () {
                    alert("An error has occured!!!");
                }
            });


            });

            $(document).on("click", "#filter_institution_unregistered", function(event) {
               $.ajax({
                url:"/admin/getunregistered-student?institution_id=" + $("#select_unregistered_institution").val(),
                type: "GET",
                datatype: "json",
                contentType: "application/json; charset=utf-8",
                success: function (json) {

                    $('#unregister_student_table').DataTable().clear().draw();
                    $('#unregister_student_table').DataTable().rows.add(json.data).draw();; // Add new data

                },
                error: function () {
                    alert("An error has occured!!!");
                }
            });


            });


} );

</script>

      @endsection