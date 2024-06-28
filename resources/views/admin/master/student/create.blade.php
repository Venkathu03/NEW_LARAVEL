 <div class="modal-header">
                                          <h5 class="modal-title text-white" style="color: #000000!important;">Create Student</h5>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                       </div>
                                       <div class="modal-body text-white">
                                          <form class="row g-3 parsley-examples" action="{{ route('student.store')}}" method="post">
                                              <input type="hidden" name="is_register" value="{{$register_type}}">
                                             @csrf
                                             <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label" style="color: #000000!important;">Student Name</label>
                                                <input type="text" required class="form-control" name="fullname">
                                             </div>
                                             <div class="col-md-6">
                                                <label for="inputFirstName" class="form-label" style="color: #000000!important;">Email Id</label>
                                                <input type="email" required class="form-control email" name="email">
                                                <span style="margin-top: 7px;" id="emailMatch"></span>
                                             </div>
                                             <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Mobile Number</label>
                                                <input type="number" class="form-control mobile" name="phone_number" required='' pattern="[6-9]{1}[0-9]{9}" autocomplete="off">
                                                  <span style="margin-top: 7px;" id="mobileMatch"></span>
                                             </div>
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Password</label>
                                                <input type="number" class="form-control CheckPassword" id="passwod" name="password" required=''>
                                                  <span style="margin-top: 7px;" id="CheckcharPasswordMatch"></span>
                                             </div>
                                              
                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Institution Type</label>
                                                <select id="institution_type" required name="institution_type" class="form-select ins_type" style="border: 1px solid #40D4FF;">
                                                   <option value="">Choose..</option>
                                                   <option value="yes">Registered</option>
                                                   <option value="no">Un Registered</option>
                                                </select>
                                             </div>

                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Institution Name</label>
                                                <select id="institution_id" required name="institution_id" class="form-select institution_id" style="border: 1px solid #40D4FF;">
                                                   <option selected value="">Choose...</option>
                                                </select>
                                             </div>
                                             
                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Course Studying</label>
                                                <select id="inputState" required class="form-select course_name" name="course_id" style="border: 1px solid #40D4FF;">
                                                   <option value="">Choose...</option>
                                                  
                                                </select>
                                             </div>
                                                
                                              <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Batch Year</label>
                                                <input type="text" required pattern="[0-9]{4}" class="form-control " name="batch_year">
                                              </div>
                                              
                                            <div class="col-md-6">
                                                <label class="form-label" style="color: #000000!important;">Studying Year</label>
                                                <select required class="form-select studying_year" name="study_year" style="border: 1px solid #40D4FF;">
                                                   <option value="">Choose...</option>
                                                  
                                                </select>
                                             </div>
                                              
<!--
                                               <div class="col-md-6">
                                                   <label class="form-label" style="color: #000000;">
                                                    Passing Year
                                                     </label>
                                                     <select class="form-select form-select-sm passing_year" name="passing_year" required>
                                                          <option value="">Choose</option>
                                                     </select>
                                                     <span style="margin-top: 7px;" id="subscribelMatch"></span>
                                              </div>
-->
                                             <div class="col-md-6">
                                                <label for="inputState" class="form-label" style="color: #000000;">Payment Status</label>
                                                <select id="inputState" required class="form-select" name="is_payment_done" style="border: 1px solid #40D4FF;" required>
                                                   <option value="">Choose...</option>
                                                   <option value="yes">Yes</option>
                                                   <option value="no">No</option>
                                                </select>
                                             </div>
                                              <input type="hidden" class="no_of_year" name="year_level">
                                              
                                             <div class="col-12">
                                                <button type="submit" class="btn btn-primary px-5 btn-submit"><i class="lni lni-circle-plus"></i>Create Student</button>
                                             </div>
                                          </form>
                                       </div>

<script>
   $(document).ready(function () {
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
                    success: function (result) {
                        $('#institution_id').html('<option value="">Choose..</option>');
                        $.each(result.institution_type, function (key, value) {
                            $("#institution_id").append('<option value="' + value
                                .id + '">' + value.institution_name + '</option>');
                        });
                    }
                });
    });

       
       $(document).on("change", ".institution_id", function(event) {           
           var data = {
               "_token": "{{ csrf_token() }}",
               institution_id:$(".institution_id").val()
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
       
  });
</script>