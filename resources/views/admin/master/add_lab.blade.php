<div class="modal-header">
    <h5 class="modal-title text-white" style="color: #000000!important;">{{ !is_null($lab) ? "Edit":"Add"}} Lab</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-white">
    <form class="row g-3" method="post" action="{{ route('admin.lab.store')}}" enctype='multipart/form-data'>
        @csrf
        
        <div class="mb-12">
            <label class="form-label" style="color: #000000!important;">Lab Name</label>
            <input type="text" class="form-control" name="lab_name" required="" value="{{ !is_null($lab) ?$lab->lab_name:''  }}"> 
        </div>
        @if(!is_null($lab))
        <input type="hidden" name="id" value="{{$lab->id}}"> 
         <div class="mb-12">
            <label class="form-label" style="color: #000000!important;">Active Status</label>
             <select type="text" class="form-select" name="active_status" required="" > 
                <option value="1" @if($lab->active_status == "1") {{ "selected='selected'"}} @endif>Active</option>
                 <option value="2" @if($lab->active_status == "2") {{ "selected='selected'"}} @endif>Inactive</option>
             </select>
        </div>
        
        @endif 
        <div class="col-12">
            <button type="submit" class="btn btn-primary px-5"><i class="lni lni-circle-plus"></i>{{ !is_null($lab) ? "Update":"Add"}}</button>
        </div>
    </form> 
</div>