<div class="modal-header">
   <h5 class="modal-title text-white" style="color: #000000!important;">Update Institute</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-white">
   <form class="row g-3" action="{{ route('institution.update',$institution->id)}}" method="post">
      @csrf
      @method('PUT')

      <input type="hidden" name="is_registered" value="{{$institution->is_registered}}">
      <div class="col-md-6">
         <label for="inputFirstName" class="form-label" style="color: #000000!important;">Institute Name</label>
         <input type="text" class="form-control" required name="institution_name" value="{{ !is_null($institution) ? $institution->institution_name:''}}" required>
      </div>
      <div class="col-md-6">
         <label class="form-label" style="color: #000000!important;">Contact Person Name</label>
         <input type="text" name="contact_name" required class="form-control" required value="{{$institution->contact_name}}">
      </div>
      
      <div class="col-md-6">
         <label class="form-label" style="color: #000000!important;">Mobile Number</label>
         <input type="text" class="form-control mobile" name="phone_number" value="{{$institution->phone_number}}" data-value="{{$institution->phone_number}}" required pattern="[6-9]{1}[0-9]{9}">
         <span style="margin-top: 7px;" class="mobileMatch11"></span>
      </div>

      <div class="col-md-6">
         <label class="form-label" style="color: #000000!important;">Designation</label>
         <input type="text" class="form-control" required name="designation" value="{{$institution->designation}}">
      </div>
      <div class="col-md-6">
         <label for="inputFirstName" class="form-label" style="color: #000000!important;">Email Id</label>
         <input type="email" class="form-control email" name="email" value="{{$institution->email}}" data-value="{{$institution->email}}" required >
         <span style="margin-top: 7px;" class="emailMatch1"></span>
      </div>
      <div class="col-md-6">
         <label class="form-label" style="color: #000000!important;">Password</label>
         <input type="password" name="password" class="form-control">
      </div>
      <div class="col-md-6">
         <label class="form-label" style="color: #000000!important;">Active Status</label>
         <select type="text" class="form-select" name="active_status" required="">
            <option value="1" @if($institution->active_status == "1") {{ "selected='selected'"}} @endif>Active</option>
            <option value="2" @if($institution->active_status == "2") {{ "selected='selected'"}} @endif>Inactive</option>
         </select>
      </div>

      <div class="col-12">
         <button type="submit" class="btn btn-primary px-5"><i class="lni lni-circle-plus"></i>Update</button>
      </div>
   </form>
</div>


<script>
   $(document).ready(function() {
      $(document).on("keyup", ".email", function(event) {
         var data = {
            "_token": "{{ csrf_token() }}",
            email: $(this).val(),
            exist_value: $(this).data('value'),
         };
         $.ajax({
            type: "POST",
            url: "{{ route('admin.check.institutionemail') }}",
            data: data,
            success: function(result) {
               if (result == "true") {
                  $(".btn-submit1").prop("disabled", true);
                  $(".emailMatch1").html("Email already Exist !").css("color", "red");
               } else {
                  $(".emailMatch1").html("").css("color", "green");
                  $(".btn-submit1").prop("disabled", false);
               }
            }
         });
      });
   });



   $(document).on("keyup", ".mobile", function(event) {
   var inputValue = $(this).val();
   var mobileRegex = /^\d{10}$/; // Regex for a 10-digit number

   if (!mobileRegex.test(inputValue)) {
      // Display an error message if the input doesn't match the expected format
      $(".mobileMatch11").html("Please enter a 10-digit mobile number.").css("color", "red");
      $(".btn-submit1").prop("disabled", true);
   } else {
      // Valid 10-digit mobile number format
      $(".mobileMatch11").html("").css("color", "green");
      $(".btn-submit1").prop("disabled", false);

      // Proceed with your AJAX request here
      var data = {
         "_token": "{{ csrf_token() }}",
         mobile: inputValue,
         exist_value: $(this).data('value'),
      };

      $.ajax({
         type: "POST",
         url: "{{ route('admin.check.institutionmobile') }}",
         data: data,
         success: function(result) {
            if (result == "true") {
               $(".btn-submit1").prop("disabled", true);
               $(".mobileMatch11").html("Mobile Number already Exist !").css("color", "red");
            } else {
               $(".mobileMatch11").html("").css("color", "green");
               $(".btn-submit1").prop("disabled", false);
            }
         }
      });
   }
});

</script>

