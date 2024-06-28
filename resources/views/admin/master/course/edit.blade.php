<div class="modal-header">
   <h5 class="modal-title text-white" style="color: #000000!important;">Update Course</h5>
   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-white">
   <form class="row g-3" action="{{ route('course.update',$course->id)}}" method="post">
      @csrf
      @method('PUT')
      <div class="col-md-6">
         <label for="inputFirstName" class="form-label" style="color: #000000!important;">Enter the Course Name</label>
         <input type="text" class="form-control" name="course_name" required value="{{$course->course_name}}" required>
      </div>
       
        <div class="col-md-6">
          <label for="inputFirstName" class="form-label" style="color: #000000!important;">Study Duration(In Years)</label>
            <input type="number" class="form-control" name="study_duration" min="1" max="10" value="{{ $course->study_duration}}" required>
        </div>

  
    <div class="col-md-6">
        <label for="inputState" class="form-label" style="color: #000000;">Status</label>
        <select id="inputState" class="form-select" name="active_status" style="border: 1px solid #40D4FF;">
         <option value="1" @if($course->active_status =="1") {{ "selected='selected'"}} @endif>Active</option>
         <option value="0" @if($course->active_status =="0") {{ "selected='selected'"}} @endif>Inactive</option>
        </select>
    </div>
       
      <div class="col-12">
         <button type="submit" class="btn btn-primary px-5"><i class="lni lni-circle-plus"></i>Update</button>
      </div>
   </form>
</div>