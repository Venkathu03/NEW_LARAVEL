$(function() {
	"use strict";
	
	
	    $(document).ready(function() {
			$('#example3').DataTable();
		  } );
		  
		  
		  
		  $(document).ready(function() {
			var table = $('#example4').DataTable( {
				lengthChange: false,
				
			} );
			
		 
			table.buttons().container()
				.appendTo( '#example2_wrapper .col-md-6:eq(0)' );
		} );
	
	
	});