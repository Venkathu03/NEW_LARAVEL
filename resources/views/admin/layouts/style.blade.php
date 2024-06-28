<style>
@font-face {
    font-family: Gilroy-Bold;
    src: url("asset('assets/fonts/Gilroy-Bold.ttf')") format('truetype');
}
@font-face {
    font-family: Gilroy-SemiBold;
    src: url("{{asset('assets/fonts/Gilroy-SemiBold.ttf')}}") format('truetype');
}
@font-face {
    font-family: Gilroy-Regular;
    src: url("{{asset('assets/fonts/Gilroy-Regular.ttf')}}") format('truetype');
}
@font-face {
    font-family: Gilroy-Thin;
    src: url("{{asset('assets/fonts/Gilroy-Thin.ttf')}}") format('truetype');
}
    .g-33 {
        width:100%;
    }
div.dt-buttons {
    margin-top:10px !important;
    border:1px solid #40D9E8 !important;
    color:#000 !important;
}
     input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
         -webkit-appearance: none;
      }
    
    .accordion {
        padding: var(--bs-card-spacer-y) var(--bs-card-spacer-x);
    }
</style>
<!--plugins-->
<link href="{{ asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{ asset('assets/admin/css/pace.min.css')}}" rel="stylesheet" />
	<script src="{{ asset('assets/js/pace.min.js')}}"></script>

	<!-- Bootstrap CSS -->
	<link href="{{ asset('assets/admin/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/admin/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/admin/css/app.css')}}" rel="stylesheet">
	<link href="{{ asset('assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{ asset('assets/admin/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{ asset('assets/admin/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{ asset('assets/admin/css/header-colors.css')}}" />