<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\InstitutionMaster;
use App\Models\Student;
use App\Models\Procedure;
use App\Models\ProcedureType;
use App\Models\ProcedureTrialMark;
use Auth;
use Session;

class ReportController extends Controller
{
    public function index(){
        $user=Auth::guard('student')->user();
        $final_data=array();
        $procedures=Procedure::where('active_status',1)->get();
        foreach($procedures as $procedure){
            $procedureFinale=array();
            $procedureFinale['procedure_name']=$procedure->procedure_name;
            $procedure_Type=explode(',',$procedure->procedure_type_id);
            foreach($procedure_Type as $pro_type){
                $procedureTypeDetails=ProcedureType::where('id',$pro_type)->where('active_status',1)->first();
                if($procedureTypeDetails){
                    $data=array();
                    $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                        ->where('procedure_type_id', $pro_type)
                        ->where('student_id', $user->id)
                        ->orderBy('id', 'desc')
                        ->take(4)
                        ->pluck('score');                

                    $count = $mark_list->count();
                    if ($count < 4) {
                        $missingValuesCount = 4 - $count;
                        $zeroValues = array_fill(0, $missingValuesCount, 0);
                        $mark_list = array_merge($mark_list->toArray(),$zeroValues);
                    }
                    $mark_list = collect($mark_list)->map(function ($value) {
                        return is_numeric($value) ? (float)$value : 0;
                    });

                    $data['procedure_type_name']=$procedureTypeDetails->procedure_type_name;
                    
                    $data['score']=$mark_list;
                    $procedureFinale['type_value'][]=$data;
                }
                
            }
            $final_data[]=$procedureFinale;
        }
        $send_data['procedures']=$final_data;
        return view('student.report',$send_data);
    }
}
