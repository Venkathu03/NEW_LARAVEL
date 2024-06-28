<div class="modal-header">
    <h5 class="modal-title text-white" style="color: #000000!important;">{{ !is_null($procedure_type) ? "Edit":"Add"}} Procedure Type</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-white">
    <form class="row g-3" method="post" action="{{ route('admin.proceduretype.store')}}" enctype='multipart/form-data'>
        @csrf

       
        <div class="mb-12">
            <label class="form-label" style="color: #000000!important;">Procedure Type</label>
            <input type="text" required class="form-control" name="procedure_type_name" required="" value="{{ !is_null($procedure_type) ?$procedure_type->procedure_type_name:''  }}"> 
        </div>

        @if(!is_null($procedure_type))
            <input type="hidden" name="id" value="{{$procedure_type->id}}"> 
             <div class="mb-12">
                <label class="form-label" style="color: #000000!important;">Active Status</label>
                 <select type="text" class="form-select" name="active_status" required="" > 
                    <option value="1" @if($procedure_type->active_status == "1") {{ "selected='selected'"}} @endif>Active</option>
                     <option value="2" @if($procedure_type->active_status == "2") {{ "selected='selected'"}} @endif>Inactive</option>
                 </select>
            </div>
         @endif
        
        <div class="col-12">
            <button type="submit" class="btn btn-primary px-5"><i class="lni lni-circle-plus"></i>{{ !is_null($procedure_type) ? "Update":"Add"}}</button>
        </div>
    </form>
</div>