@extends('admin.layouts.app')
@section('admin-content')
<div class="card shadow-none bg-transparent border-bottom border-2">
   <div class="card-body">
      <div class="row align-items-center">
         <div class="col-md-12">
            <h4 class="mb-3 mb-md-0">Subscription Management</h4>
         </div>
        
      </div>
   </div>
</div>
<div class="col">
   <div class="card">
      <div class="card-body">
       
         <div class="tab-content py-3">
            <div class="tab-pane fade show active" id="primaryprofile" role="tabpanel">
               <div class="row row-cols-1">
                  <div class="col d-flex">
                     <div class="card radius-10 w-100" style="margin-bottom: 0px;">
                            @include('admin.layouts.messages')
                        <div class="card-body">
                            
                               <div class="d-flex align-items-center">
                              <div class="g-33" style="align-items: center;width: 100%;">
                                 <div class="col1">
                                    <h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Subscription Details</h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary pull-right examplePrimaryModall"  style="float: right;"><i class="lni lni-circle-plus"></i>Add Subscription</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="examplePrimaryModal" tabindex="-1" aria-hidden="true">
                                       <div class="modal-dialog modal-lg modal-dialog-centered">
                                          <div class="modal-content bg-primary">
                                             
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                          
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                           <thead style="background-color: #E4E4E4;">
                              <tr>
                                 <th>S.No.</th>
                                 <th>Institution Name</th>
                                 <th>Course Name</th>
                                 <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($subscriptions as $key=>$subscription)
                              <tr>
                                 <td>{{$key+1}}</td>
                                 <td>@if(!is_null($subscription->institution)) {{$subscription->institution->institution_name}} @endif</td>
                                 <td>{{$subscription->course->course_name}}</td>
                                 <td>@if($subscription->active_status == "1")<span class="text-success">Active</span>@else <span class="text-danger">Inactive</span> @endif</td>
                                 <td style="display: inline-flex;"><a href="#" style="text-decoration: underline; color: #000000;" class="edit_detail" data-value="{{$subscription->id}}" data-url="{{ route('subscription.show',$subscription->id)}}">Edit</a>
                                   &nbsp
                                        <form method="POST" action="{{ route('subscription.destroy',$subscription->id)}}">
                                            @csrf
                                            <input name="_method" type="hidden" value="DELETE">
                                            <span type="submit" class="show_confirm"  style="text-decoration:underline;color:#000000;" data-toggle="tooltip" title='Delete'> Delete</span>
                                        </form>
                                  
                                  </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
          
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="addModelForm_Procedure" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content bg-primary">
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
   $(document).ready(function() {
       
            
//       $(document).on("change", ".institution_name", function(event) {           
//           var data = {
//               "_token": "{{ csrf_token() }}",
//               institution_id:$(this).val()
//           };
//           $.ajax({
//               type: "POST",
//               url: "{{ route('admin.get.course-list') }}",
//               data: data,
//               success: function(result) {
//                    $(".course_name").html('');
//                   var course = $(".course_name");
//                   course.append(result);
//               }
//           });
//       });
       
        $(document).on("click", ".examplePrimaryModall", function(event) { 
             var data = {
               "_token": "{{ csrf_token() }}"
               };
               $.ajax({
                   type: "POST",
                   url: "{{ url('admin/subscription/create')}}",
                   data: data,
                   success: function(result) {
                       $(".modal-content").empty();
                       $(".modal-content").append(result);
                       $("#addModelForm_Procedure").modal("show");
                   }
               }); 
       });
       
       $(document).on("click", ".edit_detail", function(event) {
           var userURL =$(this).data("url");
           var data = {
               "_token": "{{ csrf_token() }}",
           };
           $.ajax({
               type: "GET",
               url: userURL,
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                   $("#addModelForm_Procedure").modal("show");
               }
           });
       });
   });
    
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
                           $(".btn-submit").prop("disabled", true);
                           $("#emailMatch").html("Record Already Exist!").css("color","red");
                        }else{
                           $(".btn-submit").prop("disabled", false);
                        }
                   }
               });
       });
    
</script>
@endsection