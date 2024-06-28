@extends('admin.layouts.app')

@section('admin-content')
<div class="card shadow-none bg-transparent border-bottom border-2">
   <div class="card-body">
      <div class="row align-items-center">
         <div class="col-md-12">
            <h4 class="mb-3 mb-md-0">Master Data</h4>
         </div>
       
      </div>
   </div>
</div>

    @if (Session::has('master-procedure-type'))
     @php $master_type = 'master-procedure-type'; @endphp
    @elseif (Session::has('master-procedure'))
      @php $master_type = 'master-procedure'; @endphp
    @elseif (Session::has('mac-address'))
      @php $master_type = 'mac-address'; @endphp
    @elseif (Session::has('lab-master'))
      @php $master_type = 'lab-master'; @endphp
    @else
        @php $master_type ='';@endphp
@endif
<div class="col">
   <div class="card">
      <div class="card-body">
            @include('admin.layouts.messages')
         <ul class="nav nav-tabs nav-primary" role="tablist">
            <li class="nav-item" role="presentation">
               <a class="nav-link @if( $master_type =='lab-master' || $master_type =='' ) {{'active'}} @endif" data-bs-toggle="tab" href="#primaryprofile" role="tab"
                  aria-selected="true">
                  <div class="d-flex align-items-center">
                     <div class="tab-title">Lab</div>
                  </div>
               </a>
            </li>
            <li class="nav-item" role="presentation">
               <a class="nav-link @if( $master_type =='master-procedure-type') {{'active'}} @endif" data-bs-toggle="tab" href="#types" role="tab" aria-selected="false">
                  <div class="d-flex align-items-center">
                     <div class="tab-title">Procedure Type</div>
                  </div>
               </a>
            </li>
            <li class="nav-item" role="presentation">
               <a class="nav-link @if( $master_type =='master-procedure') {{'active'}} @endif" data-bs-toggle="tab" href="#primarychange" role="tab" aria-selected="false">
                  <div class="d-flex align-items-center">
                     <div class="tab-title">Procedures</div>
                  </div>
               </a>
            </li>
            <li class="nav-item" role="presentation">
               <a class="nav-link  @if( $master_type =='mac-address') {{'active'}} @endif" data-bs-toggle="tab" href="#primarysubscription" role="tab"
                  aria-selected="false">
                  <div class="d-flex align-items-center">
                     <div class="tab-title">MAC Address</div>
                  </div>
               </a>
            </li>
            <!--<li class="nav-item" role="presentation">
               <a class="nav-link" data-bs-toggle="tab" href="#primarypuser" role="tab" aria-selected="false">
               	<div class="d-flex align-items-center">
               		
               		<div class="tab-title">User Feedback</div>
               	</div>
               </a>
               </li>-->
         </ul>
         <div class="tab-content py-3">
            <div class="tab-pane fade @if( $master_type =='lab-master' || $master_type =='' ) {{'show active'}} @endif" id="primaryprofile" role="tabpanel">
               <div class="row row-cols-1">
                  <div class="col d-flex">
                     <div class="card radius-10 w-100" style="margin-bottom: 0px;">
                        <div class="card-body">
                           <div class="d-flex align-items-center" >
                              <div class="g-33" style="align-items: center;">
                                 <div class="col1">
                                    <h5
                                       style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">
                                       VR Lab Details
                                    </h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary addModelForm11" data-bs-toggle="modal"
                                       data-form-type="lab"   style="float: right;"><i
                                       class="lni lni-circle-plus"></i>Add</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="examplePrimaryModal" tabindex="-1"
                                       aria-hidden="true">
                                       <div class="modal-dialog modal-lg modal-dialog-centered">
                                          <div class="modal-content bg-primary">
                                             <div class="modal-header">
                                                <h5 class="modal-title text-white"
                                                   style="color: #000000!important;">VR Lab Details
                                                </h5>
                                                <div
                                                   class="d-flex align-items-center theme-icons shadow-sm p-2 cursor-pointer rounded">
                                                   <div class="font-22 text-primary"> <i
                                                      class="lni lni-trash"
                                                      style="color: #40D4FE;"></i>
                                                   </div>
                                                   <div class="ms-2"> <span><button type="button"
                                                      class="btn-close"
                                                      data-bs-dismiss="modal"
                                                      aria-label="Close"></button></span>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="modal-body text-white">
                                                <div>
                                                   <p class="mb-0 text-secondary"
                                                      style="font-size: 16px; font-weight: 400; font-family: Gilroy-Regular;">
                                                      Lab Name
                                                   </p>
                                                   <div class="position-relative search-bar-box">
                                                      <input type="text"
                                                         class="form-control search-control"
                                                         placeholder="Initial Patient Assessment VR Labs"
                                                         style="border-bottom: 1px solid #000000;">
                                                      <span
                                                         class="position-absolute top-50 search-show translate-middle-y"><i
                                                         class="lni lni-highlight-alt"
                                                         style="color: #40D4FE;"></i></span>
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
                                 <th>VR Lab Name</th>
                                  <th>Active Status</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach($lab as $key=>$lab)
                              <tr>
                                 <td>{{ $key+1}}</td>
                                 <td>{{$lab->lab_name}}</td>
                                   <td>@if($lab->active_status == "1") 
                                          <span class="text-success">Active</span>
                                          @else
                                          <span class="text-danger">Inactive</span>
                                          @endif
                                       </td>
                                 <td style="display: inline-flex;"><span  class="view_lab_master"  
                                    style="text-decoration: underline; color: #000000;" 
                                    data-form-type="lab" data-value="{{$lab->id}}">Edit</span>
                                     
                                       &nbsp
                                        <form method="POST" action="{{ route('admin.lab.destroy',$lab->id) }}">
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
            <div class="tab-pane fade @if( $master_type =='master-procedure') {{' show active'}} @endif" id="primarychange" role="tabpanel">
               <div class="row row-cols-1">
                  <div class="col d-flex">
                     <div class="card radius-10 w-100" style="margin-bottom: 0px;">
                        <div class="card-body">
                           <div class="d-flex align-items-right">
                              <div class="g-33" style="align-items: center;">
                                 <div class="col1">
                                    <h5
                                       style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">
                                       Procedures
                                    </h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary addModelForm"
                                       data-form-type="procedure" data-bs-toggle="modal"
                                       data-bs-target="#examplePrimaryModall" style="float: right;"><i
                                       class="lni lni-circle-plus"></i>Add</button>
                                 </div>
                              </div>
                           </div>
                           <div class="row row-cols-1 row-cols-sm-3 mt-4">
                              <div class="col">
                                 <label class="mb-0 text-secondary"
                                    style="font-size: 16px; font-weight: 400; font-family: Gilroy-Regular;">
                                    Filter By Procedure Type
                                 </label>
                                  <select class="form-select procedure_type_filter" >
                                      <option value="">All</option>
                                      @foreach($procedure_types_search as $type)
                                      <option value="{{$type->id}}">{{ $type->procedure_type_name}}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col">
                              </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive table-show">
                              <table id="example2" class="table table-striped table-bordered">
                                 <thead style="background-color: #E4E4E4;">
                                    <tr>
                                       <th>S.No</th>
                                       <th>Procedure ID</th>
                                       <th>Procedure Name</th>
                                       <th> Institute Name </th>
                                       <th> Procedure Allocated for </th>
                                       <th>Active Status</th>
                                       {{-- <th>Procedure Type</th> --}}
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($procedures as $key=>$procedure)
                                    <tr>
                                       <td>{{ $key+1}}</td>                                     
                                        <td>{{$procedure->id}}</td>
                                        <td>{{$procedure->procedure_name}}</td>
                                        <td>{{$procedure->institution}}</td>
                                        <td>{{$procedure->batch_year}}</td>
                                        <td>@if($procedure->active_status == "1") 
                                          <span class="text-success">Active</span>
                                          @else
                                          <span class="text-danger">Inactive</span>
                                          @endif
                                       </td>
                                       {{-- <td>
                                         @php  
                                           $array = explode(',',$procedure->procedure_id);
                                         @endphp
                                           @if(!empty($array))
                                            @php $result = ""; 
                                            $type_name = ""; @endphp
                                               @foreach($array as $p_id) 
                                                @php   $type_name = \App\Models\ProcedureType::find($p_id);
                                                 $result .= isset($type_name->procedure_type_name) ? $type_name->procedure_type_name.',':''; @endphp
                                               @endforeach
                                              {{ rtrim($result, ",") }}
                                            @endif
                                        </td> --}}
                                       <td style="display: inline-flex;"><span  class="view_master"  
                                          style="text-decoration: underline; color: #000000;" 
                                          data-form-type="procedure" data-value="{{$procedure->id}}">Edit</span>
                                           
                                            &nbsp
                                        <form method="POST" action="{{ route('admin.procedure.destroy',$procedure->id) }}">
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
            <div class="tab-pane fade @if( $master_type =='master-procedure-type') {{' show active'}} @endif" id="types" role="tabpanel">
               <div class="row row-cols-1">
                  <div class="col d-flex">
                     <div class="card radius-10 w-100" style="margin-bottom: 0px;">
                        <div class="card-body">
                           <div class="d-flex align-items-center" >
                              <div class="g-33" style="align-items: center;">
                                 <div class="col1">
                                    <h5
                                       style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">
                                       Procedure Type
                                    </h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary addModelForm"
                                       data-form-type="procedure-type" data-bs-toggle="modal"
                                       data-bs-target="#examplePrimaryModall_types" style="float: right;"><i
                                       class="lni lni-circle-plus"></i>Add</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="card-body">
                           <div class="table-responsive">
                              <table id="example3" class="table table-striped table-bordered">
                                 <thead style="background-color: #E4E4E4;">
                                    <tr>
                                       <th>S.No</th>
                                       <th>ProcedureType ID</th>
                                       <th>Procedure Type</th>
                                        <th>Active Status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    @foreach($procedure_types as $key=>$type)
                                    <tr>
                                       <td>{{ $key+1}}</td>
                                       <td>{{ $type->id}}</td>
                                       <td>{{$type->procedure_type_name}}</td>
                                        <td>@if($type->active_status == "1") 
                                                <span class="text-success">Active</span>
                                           @else
                                            <span class="text-danger">Inactive</span>
                                            @endif
                                        </td>
                                       <td style="display: inline-flex;"><span class="view_master"  style="text-decoration:underline;color:#000000;" data-form-type="procedure-type" data-value="{{$type->id}}">Edit</span>
                                           &nbsp
                                        <form method="POST" action="{{ route('admin.proceduretype.destroy',$type->id) }}">
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
            <div class="tab-pane fade @if( $master_type =='mac-address') {{'show active'}} @endif" id="primarysubscription" role="tabpanel">
               <div class="row row-cols-1">
                  <div class="col d-flex">
                     <div class="card radius-10 w-100" style="margin-bottom: 0px;">
                        <div class="card-body">
                           <div class="d-flex align-items-center">
                              <div class="g-33" style="align-items: center;">
                                 <div class="col1">
                                    <h5
                                       style="font-size: 18px; font-weight: 600; font-family: Gilroy-SemiBold;">
                                        MAC Details
                                    </h5>
                                 </div>
                                 <div class="col1" style="margin-top: 0px">
                                    <button type="button" class="btn btn-primary addModelForm"
                                       data-form-type="mac-address" data-bs-toggle="modal"
                                       data-bs-target="#examplePrimaryModall" style="float: right;"><i
                                       class="lni lni-circle-plus"></i>Add</button>
                                 </div>
                              </div>
                             </div>
                        </div>
                     </div>
                  </div>
                  <div class="card">
                     <div class="card-body">
                        <table class="table table-striped table-bordered" id="example4">
                           <thead style="background-color: #E4E4E4;">
                              <tr>
                                 <th scope="col">S.No</th>
                                 <th scope="col">Mac Address</th>
                                 <th scope="col">Institution Name</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                                    @foreach($mac_address as $key=>$mac_address)
                                    <tr>
                                       <td>{{ $key+1}}</td>
                                       <td>{{$mac_address->mac_address}}</td>
                                       <td>@if(!is_null($mac_address->institution)) {{$mac_address->institution->institution_name}} @endif</td>
                                       <td>@if($mac_address->active_status == "1") 
                                                <span class="text-success">Active</span>
                                           @else
                                            <span class="text-danger">Inactive</span>
                                            @endif
                                        </td>
                                       <td style="display: inline-flex;">
                                           <span class="view_mac_address_master"
                                       style="text-decoration:underline;color:#000000;"
                                       data-form-type="mac-address"
                                       data-value="{{$mac_address->id}}">Edit</span>
                                        &nbsp
                                        <form method="POST" action="{{ route('admin.mac_address.destroy', $mac_address->id) }}">
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

<div class="modal fade" id="addModelForm_Procedure_type" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content bg-primary">
      </div>
   </div>
</div>

<div class="modal fade" id="addModelForm_Lab" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content bg-primary">
      </div>
   </div>
</div>
<div class="modal fade" id="addModelForm_mac_address" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content bg-primary">
      </div>
   </div>
</div>

<!--end row-->
@endsection
@section('scripts')
<script>
   $(document).ready(function() {
       $(document).on("click", ".view_lab_master", function(event) {
         
           var data = {
               "_token": "{{ csrf_token() }}",
               "form_type": $(this).data("form-type"),
   			id:$(this).data("value")
           };
           $.ajax({
               type: "POST",
               url: "{{ route('admin.view.lab') }}",
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                   $("#addModelForm_Lab").modal("show");
               }
           });
       });
   });
</script>

<script>
   $(document).ready(function() {
       $(document).on("click", ".addModelForm", function(event) {
           var form_type_1 =  $(this).data("form-type");
           var data = {
               "_token": "{{ csrf_token() }}",
               "form_type": $(this).data("form-type")
           };
           $.ajax({
               type: "POST",
               url: "{{ route('admin.view.procedure') }}",
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                    if(form_type_1=="procedure-type") {
                       $("#addModelForm_Procedure_type").modal("show");
                      }else{
                        $("#addModelForm_Procedure").modal("show");
                      }
               }
           });
       });
   });
</script>
<script>
   $(document).ready(function() {
       $(document).on("click", ".view_master", function(event) {
           var form_type_1 = $(this).data("form-type");
           var data = {
               "_token": "{{ csrf_token() }}",
               "form_type": $(this).data("form-type"),
   			id:$(this).data("value")
           };
           $.ajax({
               type: "POST",
               url: "{{ route('admin.view.procedure') }}",
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                     if(form_type_1=="procedure-type") {
                       $("#addModelForm_Procedure_type").modal("show");
                      }else{
                        $("#addModelForm_Procedure").modal("show");
                      }
               }
           });
       });
   });
    
    $(document).ready(function() {
       $(".procedure_type_filter").on('change',function(){
           var data = {
            "_token": "{{ csrf_token() }}",
            procedure_type_id: $(this).val(),
        };
           //filter-procedure-type
        $.ajax({
            type: "POST",
            url: "{{ route('filter-procedure-type') }}",
            data: data,
            success: function(result) {
                $('.table-show').empty();
                $('.table-show').append(result);
            }
            }); 
         });
   });
</script>
<script>
   $(document).ready(function() {
       $(document).on("click", ".addModelForm11", function(event) {
           var data = {
               "_token": "{{ csrf_token() }}",
               "form_type": $(this).data("form-type")
           };
           $.ajax({
               type: "POST",
               url: "{{ route('admin.view.lab') }}",
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                   $("#addModelForm_Lab").modal("show");
               }
           });
       });
   });
</script>
<script>
   $(document).ready(function() {
       $(document).on("click", ".addModelForm", function(event) {
           var data = {
               "_token": "{{ csrf_token() }}",
               "form_type": $(this).data("form-type")
           };
           $.ajax({
               type: "POST",
               ///mac-address/get-form
               url: "{{ route('admin.view.mac_address') }}",
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                   $("#addModelForm_mac_address").modal("show");
               }
           });
       });
   });
</script>
<script>
   $(document).ready(function() {
       $(document).on("click", ".view_mac_address_master", function(event) {
           var data = {
               "_token": "{{ csrf_token() }}",
               "form_type": $(this).data("form-type"),
   			   id:$(this).data("value")
           };
           $.ajax({
               type: "POST",
               url: "{{ route('admin.view.mac_address') }}",
               data: data,
               success: function(result) {
                   $(".modal-content").empty();
                   $(".modal-content").append(result);
                   $("#addModelForm_mac_address").modal("show");
               }
           });
       });
   });
    

</script>
@endsection