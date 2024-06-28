@extends('admin.layouts.app')
@section('admin-content')

<div class="card shadow-none bg-transparent border-bottom border-2">
   <div class="card-body">
      <div class="row align-items-center">
         <div class="col-md-12">
            <h4 class="mb-3 mb-md-0">Announcements</h4>
         </div>
        
      </div>
   </div>
</div>
<div class="col">
   <div class="card">
      <div class="card-body">
       
         <div class="tab-content py-3">
            <div class="tab-pane fade show active" id="primaryprofile" role="tabpanel">
               
               <div class="card">
                    @include('admin.layouts.messages')
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="g-33" style="align-items: center; width: 100%;">
                                 <div class="col1">
                                    <h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Announcements Details</h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary pull-right" data-bs-toggle="modal" data-bs-target="#examplePrimaryModal" style="float: right;"><i class="lni lni-circle-plus"></i>Add Announcements</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="examplePrimaryModal" tabindex="-1" aria-hidden="true">
                                       <div class="modal-dialog modal-lg modal-dialog-centered">
                                          <div class="modal-content bg-primary">
                                             <div class="modal-header">
                                                <h5 class="modal-title text-white" style="color: #000000!important;">Add a Announcements</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                             </div>
                                             <div class="modal-body text-white">
                                                <form class="row g-3" action="{{ route('announcements.store')}}" method="post">
                                                   @csrf
                                                   <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Select Institution</label>
                                                      <select type="text" class="form-select institution_name" name="institution_name" required>
                                                         <option value="">--Select Institution--</option>
                                                         @foreach($institutions as $institution)
                                                         <option value="{{$institution->id}}">{{$institution->institution_name}}</option>
                                                         @endforeach
                                                      </select>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Title</label>
                                                      <input type="text" class="form-control title" name="title" required data-value="title">
                                                       <span class="ins-error"></span>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <label for="inputDiscription" class="form-label" style="color: #000000!important;">Description</label>
                                                      <textarea class="form-control discription" name="discription" required data-value="discription"></textarea>
                                                      <span class="ins-error"></span>
                                                   </div>

                                                    <span style="margin-top: 7px;" id="emailMatch"></span>
                                                   <div class="col-12">
                                                      <button type="submit" class="btn btn-primary px-5 btn-submit"><i class="lni lni-circle-plus"></i>Create</button>
                                                   </div>
                                                </form>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                          
                        </div>
                   
                  <div class="card-body">
                     <div class="table-responsive">
                        <table id="example" class="table table-striped table-bordered">
                           <thead style="background-color: #E4E4E4;">
                              <tr>
                                 <th>S.No.</th>
                                 <th>Institution Name</th>
                                 <th>Title</th>
                                <th>Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($announcements as $key=>$announcements)
                              <tr>
                                 
                                 <td>{{$key+1}}</td>
                                 <td>{{$announcements->institution_name}}</td>
                                 <td>{{$announcements->title}}</td>
                                 <td>@if($announcements->active_status == "1")<span class="text-success">Active</span>@else <span class="text-danger">Inactive</span> @endif</td>
                                 <td><a href="#" style="text-decoration: underline; color: #000000;" class="edit_detail" data-value="{{$announcements->id}}" data-url="{{ route('announcements.show',$announcements->id)}}">Edit</a>
                                     
                                     &nbsp
                                        <form method="POST" action="{{ route('announcements.destroy',$announcements->id)}}">
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
	
    $(document).on("click", ".delete_detail", function(event) {
        event.preventDefault();
        var userURL = $(this).data("url");
        var data = {
            "_token": "{{ csrf_token() }}",
        };
        
        var confirmation = confirm("Are you sure you want to delete this announcement?");
        if (confirmation) {
            $.ajax({
                type: "DELETE",
                url: userURL, 
                data: data,
                success: function(result) {
                    // Display success message or reload the page
                    alert("Announcement deleted successfully");
                    location.reload();
                },
                error: function(error) {
                    // Display an error message in the console
                    console.log("Error deleting announcement:", error);
                    showErrorMessage("An error occurred while deleting the announcement. Please try again later.");
                }
            });
        }
    });
});

</script>
@endsection