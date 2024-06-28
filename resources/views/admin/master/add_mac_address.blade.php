<div class="modal-header">
    <h5 class="modal-title text-white" style="color: #000000!important;">{{ !is_null($mac_address) ? "Edit":"Add"}} Mac Address</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-white">
    <form class="row g-3" method="post" action="{{ route('admin.mac_address.store')}}" method="POST" enctype='multipart/form-data'>
        @csrf
         @if(!is_null($mac_address))
        <input type="hidden" name="id" value="{{$mac_address->id}}"> 
        @endif 
        
<div class="col-md-12">
            <label for="inputState" class="form-label" style="color: #000000;">Institution Name</label>

        @if(!is_null($mac_address))
        <select id="institution_id" required name="institution_id" class="form-select" style="border: 1px solid #40D4FF;">
                <option>Choose</option>
                @foreach($institutions as $institution)
                <option value="{{ $institution->id}}"   @if( $mac_address->institution_id == $institution->id) {{ "selected='selected'"}} @endif>{{ $institution->institution_name}}</option>
                @endforeach 
            </select>
        @else
        <select required id="institution_id" name="institution_id" class="form-select" style="border: 1px solid #40D4FF;">
                        <option>Choose</option>
                        @foreach($institutions as $institution)
                        <option value="{{ $institution->id}}"  >{{ $institution->institution_name}}</option>
                        @endforeach
                    </select>

        @endif

        </div>
      
        <div class="col-md-12">
            <label class="form-label" style="color: #000000!important;">Mac Address</label>
            <input type="text" required required class="form-control" name="mac_address"  value="{{ !is_null($mac_address) ? $mac_address->mac_address : ''  }}" pattern="^\S.*\S$" required> 
        </div>
        
          <div class="col-md-12">
          @if(!is_null($mac_address))
           <label for="inputState" class="form-label" style="color: #000000;">Active Status</label>
            <select id="active_status" required name="active_status" class="form-select" style="border: 1px solid #40D4FF;">
                 <option value="1" @if($mac_address->active_status == "1") {{ "selected='selected'"}} @endif>Active</option>  
                 <option value="2" @if( $mac_address->active_status== "2") {{ "selected='selected'"}} @endif>Inactive</option>  
            </select>
         @endif
    </div>
        

        <div class="col-12">
            <button type="submit" class="btn btn-primary px-5"><i class="lni lni-circle-plus"></i>{{ !is_null($mac_address) ? "Update":"Add"}}</button>
        </div>
    </form> 
</div>