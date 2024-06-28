 <div class="modal-header">
    <h5 class="modal-title text-white" style="color: #000000!important;">Add a Institution</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
 </div>
 <div class="modal-body text-white">
    <form class="row g-3" action="{{ route('institution.store')}}" method="post">
       @csrf
       <input type="hidden" name="is_registered" value="{{$is_registered}}">
       <div class="col-md-6">
          <label for="inputFirstName" class="form-label" style="color: #000000!important;">Institute Name</label>
          <input type="text" class="form-control institution_name" name="institution_name" required data-value="institution_name">
          <span class="ins-error"></span>
       </div>
       <div class="col-md-6">
          <label class="form-label" style="color: #000000!important;">Contact Person Name</label>
          <input type="text" name="contact_name" class="form-control" required>

       </div>
       <div class="col-md-6">
         <label class="form-label" style="color: #000000!important;">Mobile Number</label>
         <input type="text" class="form-control mobile" name="phone_number" required pattern="[6-9]{1}[0-9]{9}">
         <span style="margin-top: 7px;" class="mobileMatch11"></span>
      </div>
       <div class="col-md-6">
          <label class="form-label" style="color: #000000!important;">Designation</label>
          <input type="text" class="form-control" name="designation" required>
       </div>
       
       <div class="col-md-6">
         <label for="inputFirstName" class="form-label" style="color: #000000!important;">Email Id</label>
         <input type="email" class="form-control email1" name="email" >
         <span style="margin-top: 7px;" class="emailMatch1"></span>
      </div>

       <div class="col-md-6">
          <label class="form-label" style="color: #000000!important;" autocomplete="password">Password</label>
          <input type="password" name="password" required pattern=".{6,}" class="form-control">
       </div>
       <div class="col-12">
          <button type="submit" class="btn btn-primary px-5 btn-submit"><i class="lni lni-circle-plus"></i>Create</button>
       </div>
    </form>
 </div>


 <script>
   $(document).ready(function() {
      $(document).on("keyup", ".email1", function(event) {
         var emailInput = $(this).val();
      var emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
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
