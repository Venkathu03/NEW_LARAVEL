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
use App\Models\Subscription;
use App\Models\SubscriptionFee;
use App\Models\ProcedureTrialMark;
use Auth;
use Session;
use Response;

class ProcedureController extends Controller
{
    public function Index(){
        $user = auth('student')->user();
         $procedures = Procedure::where("active_status",1)->get();
         $procedures_data = [];
                foreach($procedures as $procedure){
                    $procedureFinale=array();
                    $procedureFinale['procedure_name']=$procedure->procedure_name;
                    $procedureFinale['procedure_name']=$procedure->procedure_name;
                    $procedureFinale['description']=$procedure->description;
                    $procedureFinale['procedure_image']=$procedure->procedure_image;
                    $procedureFinale['created_at']=$procedure->created_at;
                    $procedures_data[]=$procedureFinale;
            }
        $send_data['procedures'] = $procedures;
        $mark_list=ProcedureTrialMark::where('student_id',$user->id)->orderBy('id','desc')->take(10)->get();
            $mark_list->map(function ($item, $key) {
                $proceduredetails=Procedure::find($item->procedure_id);
                $proceduretypedetails=ProcedureType::find($item->procedure_type_id);
                $item->procedure_name=$proceduredetails->procedure_name;
                $item->procedure_type_name=$proceduretypedetails->procedure_type_name;
            });
            $send_data['recent_trials'] = $mark_list;
        return view('student.procedure.index',$send_data);
    }
    
    public function ViewProcedure($procedure_id){
        
        $procedure_type_ids = Procedure::where("id",$procedure_id)->pluck('procedure_type_id')->toArray();
        $send_data['procedure_name'] = Procedure::where("id",$procedure_id)->pluck('procedure_name')->first();
        $overall_performance=ProcedureType::where('procedure_type_name','Overall performances')->first('id');
        
        $time_taken=ProcedureType::where('procedure_type_name','Timetaken / 60s')->first('id');
        $time_taken_id = !is_null($time_taken) ? $time_taken->id:0;
        $overall_performance_id = !is_null($overall_performance) ?$overall_performance->id:0;
        $send_data['overall_performance'] = $this->getOverallPerformance($procedure_id,$overall_performance_id); 
        $other_procedure_types=ProcedureType::where('procedure_type_name','!=','Overall performances')->where("active_status",1)->get(['id','procedure_type_name']);
        //dd($other_procedure_types);
        //type id from proce tbl ..
        $procedure_type_data = [];
        foreach($other_procedure_types as $other_procedure_type){
           $procedure_type=ProcedureType::where('id',$other_procedure_type->id)->first('id');
            if($procedure_type){
                $mark_list = ProcedureTrialMark::where('procedure_id',$procedure_id)
                        ->where('procedure_type_id', $procedure_type->id)
                        ->where('student_id',auth('student')->user()->id)
                        ->orderBy('id', 'desc')
                        ->take(4)
                        ->pluck('score');    
            }else{
                $mark_list=array();
            }
              $count = $mark_list->count();
                if ($count < 4) {
                    $missingValuesCount = 4 - $count;
                    $zeroValues = array_fill(0, $missingValuesCount, 0);
                    $mark_list = array_merge($zeroValues, $mark_list->toArray());
                }
                $mark_list = collect($mark_list)->map(function ($value) {
                    return is_numeric($value) ? (int)$value : 0;
                });
               $procedure_type_res['procedure_type_name'] = $other_procedure_type->procedure_type_name;
               if($other_procedure_type->id == $time_taken_id){
                   $time_taken_details = $mark_list;
               }else{
                 
                 $procedure_type_res['scores'] = $mark_list;
                 $procedure_type_data[]=$procedure_type_res;
               }
        }
        
        
        
        $send_data['time_taken_details'] = isset($time_taken_details) ? $time_taken_details:'';
        $send_data['other_procedure_types'] = $procedure_type_data;
        
        
        
        return view('student.procedure.view',$send_data);
    }
    
    
     public function getOverallPerformance($procedure_id,$pro_type_id){
        $score = ProcedureTrialMark::where('student_id',auth('student')->user()->id)->where('procedure_id',$procedure_id)->where('procedure_type_id',$pro_type_id)->get();
            if ($score->isNotEmpty()) {
                $count = $score->count();
                $sum = $score->sum('score');
                $avg = $sum / $count;
                $score->avg =(int)$avg;
            } else {
                $score->avg = 0;
            }
         $no_of_procedure = count($score);
        if($no_of_procedure > 0){          
           $percent =  $score->sum('score') / $no_of_procedure; 
        }else{
            $percent = 0;
        }
         return round($percent);    
        
    }
    
    public function TimeTakenMarks($procedure_id){
         $time_taken=ProcedureType::where('procedure_type_name','Timetaken / 60s')->first('id');
            if($time_taken){
                $mark_list = ProcedureTrialMark::where('procedure_id',$procedure_id)
                        ->where('procedure_type_id', $time_taken->id)
                        ->where('student_id',auth('student')->user()->id)
                        ->orderBy('id', 'desc')
                        ->take(4)
                        ->pluck('score');    
            }else{
                $mark_list=array();
            }
          $count = $mark_list->count();
            if ($count < 4) {
                $missingValuesCount = 4 - $count;
                $zeroValues = array_fill(0, $missingValuesCount, 0);
                $mark_list = array_merge($zeroValues, $mark_list->toArray());
            }
            $mark_list = collect($mark_list)->map(function ($value) {
                return is_numeric($value) ? (int)$value : 0;
            });
        
        return $mark_list;
    }
}
