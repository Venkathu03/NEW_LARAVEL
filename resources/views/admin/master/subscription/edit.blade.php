<div class="modal-header">
   <h5 class="modal-title text-white" style="color: #000000!important;">Update Subscription </h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
                <div class="modal-body text-white">
                   <form class="row g-3" action="{{ route('subscription.update',$subscription->id)}}" method="post">
                      @csrf
                      @method('PUT')
                      <div class="col-md-6">
                         <label for="inputFirstName" class="form-label" style="color: #000000!important;">Institution Name</label>
                          <select type="text" class="form-select institution_name" name="institution_id" required>
                             <option value="">--Select Institution--</option>
                              @foreach($institutions as $institution)
                                <option value="{{$institution->id}}" @if($institution->id == $subscription->institution_id) {{ "selected='selected'"}} @endif>{{$institution->institution_name}}</option>
                              @endforeach
                        </select>
                     </div>
                      <div class="col-md-6">
                             <label for="inputFirstName" class="form-label" style="color: #000000!important;">Select Course</label>
                            <select type="text" class="form-select course_name" name="course_id" required>
                            <option value="">--Select Course--</option>
                               @foreach($courses as $course)
                                  <option value="{{$course->id}}" @if($course->id == $subscription->course_id) {{ "selected='selected'"}} @endif>{{$course->course_name}}</option>
                                @endforeach
                            </select>
                        </div>
                     <div class="row show-class">
                         @foreach($subscription_fees as $key=>$fee)
                             <div class="col-md-3 mt-4">
                            <label for="inputFirstName" class="form-label" style="color: #000000!important;">{{ IntoString($key+1)}} Year Fee</label>
                              <input type="number" class="form-control" value="{{$fee->fees}}" name="study_duration[]" min="0" required>
                              </div>
                        @endforeach
                   </div>
                                    <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Course Started At</label>
                                                       <select type="text" class="form-select course_start_at" name="course_start_at" required>
                                                              <option value="">Choose</option>
                                                            <option value="1" @if($subscription->course_start_at==1) {{ "selected='selected'"}} @endif>January</option>
                                                            <option value="2" @if($subscription->course_start_at==2) {{ "selected='selected'"}} @endif>February</option>
                                                            <option value="3" @if($subscription->course_start_at==3) {{ "selected='selected'"}} @endif>March</option>
                                                             <option value="4" @if($subscription->course_start_at==4) {{ "selected='selected'"}} @endif>April</option>
                                                             <option value="5" @if($subscription->course_start_at==5) {{ "selected='selected'"}} @endif>May</option>
                                                             <option value="6" @if($subscription->course_start_at==6) {{ "selected='selected'"}} @endif>June</option>
                                                             <option value="7" @if($subscription->course_start_at==7) {{ "selected='selected'"}} @endif>July</option>
                                                             <option value="8" @if($subscription->course_start_at==8) {{ "selected='selected'"}} @endif>August</option>
                                                             <option value="9" @if($subscription->course_start_at==9) {{ "selected='selected'"}} @endif>September</option>
                                                             <option value="10" @if($subscription->course_start_at==10) {{ "selected='selected'"}} @endif>October</option>
                                                             <option value="11" @if($subscription->course_start_at==11) {{ "selected='selected'"}} @endif>November </option>
                                                             <option value="12" @if($subscription->course_start_at==12) {{ "selected='selected'"}} @endif>December</option>
                                                           
                                                       </select>
                                                   </div>
                                                    
                                                     <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Course End At</label>
                                                       <select type="text" class="form-select course_start_at" name="course_end_at" required>
                                                            <option value="">Choose</option>
                                                             <option value="1" @if($subscription->course_end_at==1) {{ "selected='selected'"}} @endif>January</option>
                                                            <option value="2" @if($subscription->course_end_at==2) {{ "selected='selected'"}} @endif>February</option>
                                                            <option value="3" @if($subscription->course_end_at==3) {{ "selected='selected'"}} @endif>March</option>
                                                             <option value="4" @if($subscription->course_end_at==4) {{ "selected='selected'"}} @endif>April</option>
                                                             <option value="5" @if($subscription->course_end_at==5) {{ "selected='selected'"}} @endif>May</option>
                                                             <option value="6" @if($subscription->course_end_at==6) {{ "selected='selected'"}} @endif>June</option>
                                                             <option value="7" @if($subscription->course_end_at==7) {{ "selected='selected'"}} @endif>July</option>
                                                             <option value="8" @if($subscription->course_end_at==8) {{ "selected='selected'"}} @endif>August</option>
                                                             <option value="9" @if($subscription->course_end_at==9) {{ "selected='selected'"}} @endif>September</option>
                                                             <option value="10" @if($subscription->course_end_at==10) {{ "selected='selected'"}} @endif>October</option>
                                                             <option value="11" @if($subscription->course_end_at==11) {{ "selected='selected'"}} @endif>November </option>
                                                             <option value="12" @if($subscription->course_end_at==12) {{ "selected='selected'"}} @endif>December</option>
                                                           
                                                       </select>
                                                   </div>
                                                   
                                                   <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Active Status</label>
                                                      <select class="form-select" name="active_status" required>
                                                         <option value="1" @if($subscription->active_status =="1"){{ "selected='selected'"}} @endif>Active</option>
                                                         <option value="2" @if($subscription->active_status =="2"){{ "selected='selected'"}} @endif>Inactive</option>   
                                                   </select>
                                                   </div>
            <span style="margin-top: 7px;" id="emailMatch"></span>
            <div class="col-12">
               <button type="submit" class="btn btn-primary px-5 btn-submit"><i class="lni lni-circle-plus"></i>Update</button>
            </div>
        </form>
</div>


@section('scripts')
<script>
    $(document).ready(function() {
       $(document).on("change", ".course_name", function(event) {
           var data = {
               "_token": "{{ csrf_token() }}",
               id:$(this).val()
           };
           $.ajax({
               type: "POST",
               url: "{{ route('admin.show.subscription') }}",
               data: data,
               success: function(result) {
                   $(".show-class").empty();
                   $(".show-class").append(result);
               }
           });
       });
        
        
      $(document).on("keyup", ".passing_year", function(event) {
             var data = {
                   "_token": "{{ csrf_token() }}",
                    passing_year:$(this).val(),
                    course_id:$(".course_name").val(),
                    institution_id:$(".institution_name").val()
               };
               $.ajax({
                   type: "POST",
                   url: "{{ route('admin.check.subscription') }}",
                   data: data,
                   success: function(result) {
                       if(result == "true"){
                           $(".btn-submit").prop("disabled", true);
                           $("#emailMatch").html("Record Already Exist!").css("color","red");
                        }else{
                           $(".btn-submit").prop("disabled", false);
                        }
                   }
               });
       });
        
        
      $(document).on("change", ".course_name , .institution_name", function(event) {
               var data = {
                   "_token": "{{ csrf_token() }}",
                    passing_year:$(".passing_year").val(),
                    course_id:$(".course_name").val(),
                    institution_id:$(".institution_name").val()
               };
               $.ajax({
                   type: "POST",
                   url: "{{ route('admin.check.subscription') }}",
                   data: data,
                   success: function(result) {
                       if(result == "true"){
                           $("#emailMatch").html("Record Already Exist!").css("color","red");
                        }else{
                           $("#emailMatch").html("").css("color","red");
                        }
                   }
               });
       });  
        
        
        
        
        
        
    });
</script>
@endsection