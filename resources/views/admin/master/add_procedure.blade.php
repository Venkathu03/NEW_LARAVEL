<div class="modal-header">
    <h5 class="modal-title text-white" style="color: #000000!important;">{{ isset($procedure) && !is_null($procedure) ? "Edit":"Add"}} Procedure</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body text-white">


    <form class="row g-3" method="post" action="{{ route('admin.procedure.store')}}" enctype='multipart/form-data' onsubmit="return Validate(this);">
        @csrf

        <div class="col-md-6">
            <label class="form-label" style="color: #000000!important;">Procedure Name</label>
            <input type="text" required class="form-control" name="procedure_name" value="{{ isset($procedure) && !is_null($procedure) ? $procedure->procedure_name:''}}">
        </div>
        <div class="col-md-6">
            <label for="formFile" class="form-label" style="color: #000000!important;">Procedure Image (JPG or PNG only)</label>
            <input class="form-control" type="file" id="formFile" @if(!isset($procedure)) {{"required"}} @endif accept=".jpg, .jpeg, .png" name="image">
        </div>
        <div class="col-md-6">
            <label for="inputState" class="form-label" style="color: #000000;">Institution Name</label>
        <select required id="institution_id" name="institution_id" class="form-select" style="border: 1px solid #40D4FF;">
                        <option>Choose</option>
                        <option value="Pondicherry Institute Of Medical Sciences"  >Pondicherry Institute Of Medical Sciences</option>
                        <option value="Test_Institute"> Test_Institute </option>
                    </select>
</div>
<div class="col-md-6">
            <label for="inputState" class="form-label" style="color: #000000;">Batch Year</label>
        <select required id="batch_year" name="batch_year" class="form-select" style="border: 1px solid #40D4FF;">
                        <option>Choose</option>
                        <option value="2018"  >2018</option>
                        <option value="2019"> 2019 </option>
                        <option value="2020"> 2020 </option>
                        <option value="2021"> 2021 </option>

                    </select>
</div>
        <div class="col-md-6">
            <label for="formFile" class="form-label" style="color: #000000!important;">Description</label>
            <textarea class="form-control" name="description" value="{{ isset($procedure) && !is_null($procedure) ? $procedure->description:''}}">{{ isset($procedure) && !is_null($procedure) ? $procedure->description:''}}</textarea>
        </div>

        <div class="mb-4">
            <label for="inputState" class="form-label" style="color: #000000!important;">Procedure
                Types</label>
            <div class="bootstrap-demo">
                @foreach($procedure_types as $type)
                <label style="color: #000000; width: 30%;" class="checkbox-inline">
                    @php
                    if(isset($procedure)){
                    $type_arr = preg_split ("/\,/",$procedure->procedure_type_id);
                    }else{
                    $type_arr ="";
                    }

                    @endphp
                    <input type="checkbox" name="procedure_type_ids[]" value="{{$type->id}}" @if( isset($procedure) && in_array($type->id,$type_arr)) {{ "checked"}} @endif> {{$type->procedure_type_name}}
                    <br> <br>
                </label>
                @endforeach

            </div>
        </div>

        @if(isset($procedure) && !is_null($procedure))
        <input type="hidden" name="id" value="{{$procedure->id}}">
        <div class="col-md-6">
            <label class="form-label" style="color: #000000!important;">Active Status</label>
            <select type="text" class="form-select" name="active_status" required="">
                <option value="1" @if($procedure->active_status == "1") {{ "selected='selected'"}} @endif>Active</option>
                <option value="2" @if($procedure->active_status == "2") {{ "selected='selected'"}} @endif>Inactive</option>
            </select>
        </div>
        @endif

        <div class="col-12">
            <button type="submit" class="btn btn-primary px-5"><i class="lni lni-circle-plus"></i>{{ isset($procedure) && !is_null($procedure) ? "Update":"Add"}}</button>
        </div>
    </form>

</div>