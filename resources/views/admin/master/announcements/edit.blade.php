<div class="modal-header">
   <h5 class="modal-title text-white" style="color: #000000!important;">Update Announcements </h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-white">
   <form class="row g-3" action="{{ route('announcements.update',$announcements->id)}}" method="post">
      @csrf
      @method('PUT')
      <div class="col-md-6">
         <label for="inputFirstName" class="form-label" style="color: #000000!important;">Select Institution</label>
          <select type="text" class="form-select institution_name" name="institution_name" required>
             <option value="">--Select Institution--</option>
              @foreach($institutions as $institution)
              <option value="{{ $institution->id }}" @if($institution->id == $announcements->institution_id) selected="selected" @endif>{{ $institution->institution_name }}</option> 
              <!-- <option value="{{$institution->id}}" @if($institution->id == $announcements->institution_name) {{ "selected='selected'"}} @endif>{{$institution->institution_name}}</option> -->
              @endforeach
        </select>
     </div>
     <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Title</label>
                                                      <input type="text" class="form-control title" value="{{$announcements->title}}" name="title" required data-value="title">
                                                       <span class="ins-error"></span>
                                                   </div>
                                                   <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Description</label>
                                                      <input type="text" class="form-control discription" value="{{$announcements->discription}}" name="discription" required data-value="discription">
                                                       <span class="ins-error"></span>
                                                   </div>
     
                                                  
                                                   
                                                   <div class="col-md-6">
                                                      <label for="inputFirstName" class="form-label" style="color: #000000!important;">Active Status</label>
                                                      <select class="form-control" name="active_status" required>
                                                         <option value="1" @if($announcements->active_status =="1"){{ "selected='selected'"}} @endif>Active</option>
                                                         <option value="2" @if($announcements->active_status =="2"){{ "selected='selected'"}} @endif>Inactive</option>   
                                                   </select>
                                                   </div>
            <span style="margin-top: 7px;" id="emailMatch"></span>
            <div class="col-12">
               <button type="submit" class="btn btn-primary px-5 btn-submit"><i class="lni lni-circle-plus"></i>Update</button>
            </div>
        </form>
</div>


@section('scripts')
<script>
    $(document).ready(function() {
       $(document).on("change", ".course_name", function(event) {
           var data = {
               "_token": "{{ csrf_token() }}",
               id:$(this).val()
           };
           $.ajax({
               type: "POST",
               url: "{{ route('admin.show.announcements') }}",
               data: data,
               success: function(result) {
                   $(".show-class").empty();
                   $(".show-class").append(result);
               }
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
                   url: "{{ route('admin.check.announcements') }}",
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
                   url: "{{ route('admin.check.announcements') }}",
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
        
        
        
        
        
        
    });
</script>
@endsection