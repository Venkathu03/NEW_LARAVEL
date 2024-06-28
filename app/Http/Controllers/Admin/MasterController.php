<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedure;
use App\Models\ProcedureType;
use App\Models\LabMaster;
use App\Models\MacAddressMaster;
use DB;

class MasterController extends Controller
{
    public function Index(){
        $send_data['procedures'] = Procedure::where('active_status','!=',3)->get();
        $send_data['procedure_types'] = ProcedureType::where('active_status','!=',3)->get();
         $send_data['procedure_types_search'] = ProcedureType::where('active_status',1)->get();
        $send_data['lab'] = LabMaster::where('active_status','!=',3)->get();
         $send_data['mac_address'] = MacAddressMaster::where('active_status','!=',3)->get();
        return view('admin.master.index',$send_data);
    }
    
    public function FilterByType(Request $request){
        if(!is_null($request->procedure_type_id)){
          
            $send_data['procedures'] = DB::table("procedures")->select("procedures.*")->whereRaw("find_in_set('".$request->procedure_type_id."',procedures.procedure_type_id)")->get();
            
        }else{
             $send_data['procedures'] = Procedure::all();
        }
        return view('admin.master.procedure_filter',$send_data);
    }
}
