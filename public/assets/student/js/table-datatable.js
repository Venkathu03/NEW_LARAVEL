
$(function() {

    "use strict";



         $(document).ready(function() {

            var table = $('#example').DataTable( {

                lengthChange: true

            } );



            table.buttons().container()

                .appendTo( '#example_wrapper .col-md-6:eq(0)' );

        } );

     $(document).ready(function() {

            var table = $('#example3').DataTable( {

                lengthChange: true

            } );



            table.buttons().container()

                .appendTo( '#example3_wrapper .col-md-6:eq(0)' );

        } );

 $(document).ready(function() {

            var table = $('#example4').DataTable( {

                lengthChange: true

            } );



            table.buttons().container()

                .appendTo( '#example4_wrapper .col-md-6:eq(0)' );

        } );

          $(document).ready(function() {

            var table = $('#example2').DataTable( {

                lengthChange: true,

            } );



            table.buttons().container()

                .appendTo( '#example2_wrapper .col-md-6:eq(0)' );

        } );
    
       $(document).ready(function() {

            var table = $('#example21').DataTable( {

                lengthChange: false,

                buttons: ['excel']

            } );



            table.buttons().container()

                .appendTo( '#example21_wrapper .col-md-6:eq(0)' );

        } );



    });