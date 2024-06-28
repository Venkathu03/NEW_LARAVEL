<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use App\Models\Student;
use App\Models\InstitutionMaster;
use App\Models\ProcedureTrialMark;
use App\Models\Procedure;
use App\Models\ProcedureType;
use App\Models\MacAddressMaster;
use Hash;
use Auth;
use Validator;

class ScoreController extends Controller
{
     use ApiResponser;
    
     public function StoreScore(Request $request){
          try {
            $user = Auth::user();
            if($user->id!=442){
                $rules = ['procedure_id' => 'required','procedure_type_id'=>'required','score'=>'required','mac_address'=>'required'];    
            }else{
                $rules = ['procedure_id' => 'required','procedure_type_id'=>'required','score'=>'required'];
            }
            
            $validator = Validator::make($request->all() , $rules);
            if ($validator->fails())
            {
                return response()
                    ->json(array(
                    'errors' => $validator->getMessageBag()
                        ->toArray()
                ),422);
            }
            
            if($user->id!=442){
             $mac = MacAddressMaster::where("institution_id",$user->institution_id)->where('mac_address',$request->mac_address)->first();   
            }
             //if(!is_null($mac)){
                    $checkProcedure=Procedure::where('active_status',1)->where('id',$request->procedure_id)->first();
                    $checkTypeProcedure=ProcedureType::where('active_status',1)->where('id',$request->procedure_type_id)->first();
                    
                    if(!$checkProcedure){
                        return response()->json(['status' => false, 'message' => 'Procedure not Found'], 200); 
                    }
                    if(!$checkTypeProcedure){
                        return response()->json(['status' => false, 'message' => 'ProcedureType not Found'], 200); 
                    }
                $procedure_mark = new ProcedureTrialMark;
                $procedure_mark->procedure_id = $request->procedure_id;
                $procedure_mark->procedure_type_id = $request->procedure_type_id;
                $procedure_mark->student_id = $user->id;
                $procedure_mark->score = $request->score;
                if(!is_null($mac)){
                    $procedure_mark->mac_address = $mac->id;
                }
                $procedure_mark->save();
                $data['score_id']=$procedure_mark->id;
                return $this->success($data,'Score has been added successfully');  
            // }else{
            //      return response()->json(['status' => false, 'message' => 'Mac address is not Found'], 200); 
            // } 

        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
     }
}
