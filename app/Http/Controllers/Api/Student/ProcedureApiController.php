<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedure;
use App\Models\ProcedureType;
use App\Traits\ApiResponser;

class ProcedureApiController extends Controller
{
    use ApiResponser;
    
    public function procedures(){
      try {
            $procedures = Procedure::where('active_status',1)->get();
             $data = [];
             foreach($procedures as $procedure){
                  $item = [
                    "id" => $procedure->id,
                    "procedure_name" => $procedure->procedure_name,
                    "procedure_types" => [],
                ];
                 $arr_ids = preg_split("/\,/",$procedure->procedure_type_id);
                 $proce_types = ProcedureType::whereIn('id',$arr_ids)->where('active_status',1)->get();
                 foreach($proce_types as $proce_type){
                    $subitems = [];
                      $item["procedure_types"][] = [
                        "procedure_type_id" => $proce_type['id'],
                        "procedure_type_name" => $proce_type['procedure_type_name']
                    ];
                 }               
                  $data[] = $item;
             }
        return $this->success($data, 'Procedure Detail Found');  
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
