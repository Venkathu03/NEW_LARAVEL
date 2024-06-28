<!-- Bootstrap JS -->
<script src="{{ asset('assets/student/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->

<script src="{{ asset('assets/student/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{ asset('assets/student/js/jquery.min.js')}}"></script>
<script src="{{ asset('assets/student/plugins/metismenu/js/metisMenu.min.js')}}"></script>

<script src="{{ asset('assets/student/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{ asset('assets/student/plugins/apexcharts-bundle/js/apexcharts.min.js')}}"></script>
<script src="{{ asset('assets/student/plugins/apexcharts-bundle/js/apex-custom.js')}}"></script>

<script src="{{ asset('assets/student/js/app.js')}}"></script>
<script src="{{ asset('assets/student/js/progressbar.js')}}"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

<script>
  
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

	


