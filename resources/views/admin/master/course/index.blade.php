@extends('admin.layouts.app')
@section('admin-content')
<div class="card shadow-none bg-transparent border-bottom border-2">
   <div class="card-body">
      <div class="row align-items-center">
         <div class="col-md-12">
            <h4 class="mb-3 mb-md-0">Course Management</h4>
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
                           <div class="d-flex align-items-center" >
                              <div class="g-33" style="align-items: center;">
                                 <div class="col1">
                                    <h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Course Details</h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary pull-right examplePrimaryModall"  style="float: right;"><i class="lni lni-circle-plus"></i>Add Course</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="examplePrimaryModal" tabindex="-1" aria-hidden="true">
                                       <div class="modal-dialog modal-md modal-dialog-centered">
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
                                 <th>Course Name</th>
                                  <th>Study Duration</th>
                                 <th>Active Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($courses as $key=>$course)
                              <tr>
                                 <td>{{$key+1}}</td>
                                 <td>{{$course->course_name}}</td>
                                  <td>{{$course->study_duration}}</td>
                                 <td>@if($course->active_status == "1") <span class="text-success">Active</span>
                                   @else 
                                   <span class="text-danger">Inactive</span>
                                   @endif</td>
                                 <td style="display: inline-flex;"><a href="#" style="text-decoration: underline; color: #000000;" class="edit_detail" data-value="{{$course->id}}" data-url="{{ route('course.show',$course->id)}}">Edit</a> 
                                     
                                       &nbsp
                                        <form method="POST" action="{{ route('course.destroy',$course->id)}}">
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
   <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content bg-primary">
      </div>
   </div>
</div>
@endsection
@section('scripts')
<script>
   $(document).ready(function() {
           $(document).on("click", ".examplePrimaryModall", function(event) { 
             var data = {
               "_token": "{{ csrf_token() }}"
               };
               $.ajax({
                   type: "POST",
                   url: "{{ url('admin/course/create')}}",
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
</script>
@endsection