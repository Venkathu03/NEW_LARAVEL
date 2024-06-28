<!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{ asset('assets/js/jquery.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{ asset('assets/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
<script src="{{ asset('assets/student/plugins/apexcharts-bundle/js/apex-custom.js')}}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	
	
    <script src="{{ asset('assets/js/progressbar.js')}}"></script>
	<script src="{{ asset('assets/js/index.js')}}"></script>
	<script src="{{ asset('assets/js/index2.js')}}"></script>
	<script src="{{ asset('assets/js/table-datatable.js')}}"></script>
	<!--app JS-->
	<script src="{{ asset('assets/js/app.js')}}"></script>

   
   <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <script type="text/javascript">

         $('.show_confirm').click(function(event) {
              var form =  $(this).closest("form");
              var name = $(this).data("name");
              event.preventDefault();
              swal({
                  title: `Are you sure you want to delete this record?`,
                  text: "If you delete this, it will be gone forever.",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                  form.submit();
                }
              });
          });
   $(".alert").show().delay(3000).fadeOut();
        
    //check file upload format        
var _validFileExtensions = [".jpg", ".jpeg", ".png"];    
function Validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    
                     swal({
                          title: "Sorry, uploaded file is invalid",
                          text: "allowed extensions are: " + _validFileExtensions.join(", "),
                          icon: "warning",
                          buttons: true,
                          dangerMode: true,
                    });
                    
                    return false;
                }
            }
        }
    }
  
    return true;
}
    </script>



