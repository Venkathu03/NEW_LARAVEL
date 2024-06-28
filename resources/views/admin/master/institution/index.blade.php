@extends('admin.layouts.app')
@section('admin-content')
<div class="card shadow-none bg-transparent border-bottom border-2">
   <div class="card-body">
      <div class="row align-items-center">
         <div class="col-md-12">
            <h4 class="mb-3 mb-md-0">Institution Management</h4>
         </div>
        
      </div>
   </div>
</div>
<div class="col">
   <div class="card">
      <div class="card-body">
               @include('admin.layouts.messages')
         <ul class="nav nav-tabs nav-primary" role="tablist">
            <li class="nav-item" role="presentation">
               <a class="nav-link active" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="true">
                  <div class="d-flex align-items-center">
                     <div class="tab-title">Registered Institution</div>
                  </div>
               </a>
            </li>
            <li class="nav-item" role="presentation">
               <a class="nav-link" data-bs-toggle="tab" href="#primarychange" role="tab" aria-selected="false">
                  <div class="d-flex align-items-center">
                     <div class="tab-title">UnRegistered Institution</div>
                  </div>
               </a>
            </li>
          
         </ul>
         <div class="tab-content py-3">
            <div class="tab-pane fade show active" id="primaryprofile" role="tabpanel">
               <div class="row row-cols-1">
                  <div class="col d-flex">
                     <div class="card radius-10 w-100" style="margin-bottom: 0px;">
                        <div class="card-body">
                           <div class="d-flex align-items-center" >
                              <div class="g-33">
                                 <div class="col1">
                                    <h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Institution Details</h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary  examplePrimaryModall" data-value="yes"  style="float:right;" ><i class="lni lni-circle-plus"></i>Add Institution</button>
                                    
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
                                 <th>Contact Name</th>
                                  <th>Email</th>
                                 <th>Mobile Number</th>
                                 <th>Designation</th>
                                  <th>Active Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($registered as $key=>$institution)
                              <tr>
                                 <td>{{$key+1}}</td>
                                 <td>{{$institution->institution_name}}</td>
                                 <td>{{$institution->contact_name}}</td>
                                  <td>{{$institution->email}}</td>
                                 <td>{{$institution->phone_number}}</td>
                                 <td>{{$institution->designation}}</td>
                                    <td>@if($institution->active_status == "1") 
                                          <span class="text-success">Active</span>
                                          @else
                                          <span class="text-danger">Inactive</span>
                                          @endif
                                       </td>
                                 <td style="display: inline-flex;">
                                      <a href="{{ url('admin/view-institution/'.$institution->id)}}" style="text-decoration: underline; color: #000000;">View</a>&nbsp;
                                     
                                     <a href="#" style="text-decoration: underline; color: #000000;" class="edit_detail" data-value="{{$institution->id}}" data-url="{{ url('admin/edit/institution')}}">Edit</a>
                                  
                                    &nbsp
                                        <form method="POST" action="{{ url('admin/institution/destroy/'.$institution->id) }}">
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
            <div class="tab-pane fade" id="primarychange" role="tabpanel">
               <div class="row row-cols-1">
                  <div class="col d-flex">
                     <div class="card radius-10 w-100" style="margin-bottom: 0px;">
                        <div class="card-body">
                           <div class="d-flex align-items-center" >
                              <div class="g-33" style="align-items: center;">
                                 <div class="col1">
                                    <h5 style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">Institution Details</h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary examplePrimaryModall" data-value="no"  style="float: right;"><i class="lni lni-circle-plus"></i>Add Institution</button>
                                    <div class="modal fade"  tabindex="-1" aria-hidden="true">
                                       <div class="modal-dialog modal-lg modal-dialog-centered">
                                          <div class="modal-content bg-primary">                                             
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                              <table id="example2" class="table table-striped table-bordered">
                                 <thead style="background-color: #E4E4E4;">
                                    <tr>
                                       <th>S.No.</th>
                                       <th>Institution Name</th>
                                       <th>Contact Name</th>
                                        <th>Email</th>
                                       <th>Mobile Number</th>
                                       <th>Designation</th>
                                         <th>Active Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($un_registered as $key=>$institution)
                                    <tr>
                                       <td>{{$key+1}}</td>
                                       <td>{{$institution->institution_name}}</td>
                                       <td>{{$institution->contact_name}}</td>
                                        <td>{{$institution->email}}</td>
                                       <td>{{$institution->phone_number}}</td>
                                       <td>{{$institution->designation}}</td>
                                        <td>@if($institution->active_status == "1") 
                                          <span class="text-success">Active</span>
                                          @else
                                          <span class="text-danger">Inactive</span>
                                          @endif
                                       </td>
                                       <td style="display: inline-flex;">
                                           <a href="{{ url('admin/view-institution/'.$institution->id)}}" style="text-decoration: underline; color: #000000;">View</a>&nbsp;
                                           <a href="#" style="text-decoration: underline; color: #000000;"  class="edit_detail" data-value="{{$institution->id}}" data-url="{{ url('admin/edit/institution')}}">Edit</a>
                                         &nbsp
                                        <form method="POST" action="{{ url('admin/institution/destroy/'.$institution->id) }}">
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
       $(document).on("click", ".examplePrimaryModall", function(event) { 
             var data = {
               "_token": "{{ csrf_token() }}",
   			   is_registered:$(this).data("value")
               };
               $.ajax({
                   type: "POST",
                   url: "{{ url('admin/institution/create')}}",
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
   			 id:$(this).data("value")
           };
           $.ajax({
               type: "POST",
               url: userURL,
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                   $("#addModelForm_Procedure").modal("show");
               }
           });
       });
       
        $(document).on("keyup", ".institution_name , .email , .mobile", function(event) {
            if($(this).data("value") == "institution_name"){
                 var data = {
                   "_token": "{{ csrf_token() }}",
                   institution_name:$(this).val(),
                   type:"institution"
                };
                }else if($(this).data("value") == "email"){
                    var data = {
                       "_token": "{{ csrf_token() }}",
                       email:$(this).val(),
                       type:"email"
                    }; 
                }else{
                 var data = {
                   "_token": "{{ csrf_token() }}",
                   mobile:$(this).val(),
                   type:"mobile"
                };
            }
           
           $.ajax({
               type: "POST",
               url: "{{ route('admin.check.institution') }}",
               data: data,
               success: function(result) {
                   if(result.status == "true"){
                       $(".btn-submit").prop("disabled", true);
                       if(result.type =="institution"){
                            $(".ins-error").html(result.error_msg).css("color","red");
                        }else if(result.type =="email"){
                            $(".email-error").html(result.error_msg).css("color","red");
                        }else{
                            $(".mobile-error").html(result.error_msg).css("color","red");     
                        }
                     
                    }else{
                        if(result.type =="institution"){
                            $(".ins-error").html("").css("color","red");
                        }else if(result.type =="email"){
                            $(".email-error").html("").css("color","red");
                        }else{
                            $(".mobile-error").html("").css("color","red");     
                        }
                       $(".btn-submit").prop("disabled", false);
                    }
               }
           });
        });
       
   });
</script>
@endsection