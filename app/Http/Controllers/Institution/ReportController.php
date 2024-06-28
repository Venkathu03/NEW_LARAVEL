<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstitutionMaster;
use App\Models\Course;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Student;
use App\Models\Procedure;
use App\Models\ProcedureType;
use App\Models\ProcedureTrialMark;
use Auth;
use Session;

class ReportController extends Controller
{
    public function index(){
         if(!auth('institution')->user()){
            return redirect('/institution/login');
         }
        $user=Auth::guard('institution')->user();
        $student_list=Student::where('institution_id',$user->id)->pluck('id')->toArray();
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
                        ->whereIn('student_id', $student_list)
                        ->orderBy('id', 'desc')
                        ->sum('score');                
                        $count =  ProcedureTrialMark::where('procedure_id', $procedure->id)
                        ->where('procedure_type_id', $pro_type)
                        ->whereIn('student_id', $student_list)->count();
                        if($count!=0){
                            $number=$mark_list/$count;
                            $avg=(int) $number;
                        }else{
                            $avg=0;
                        }
                        
                        // $avg = collect($avg)->map(function ($value) {
                        //     return is_numeric($value) ? (float)$value : 0;
                        // });
                    $data['procedure_type_name']=$procedureTypeDetails->procedure_type_name;
                    $data['score'][0]=$avg;
                    $procedureFinale['type_value'][]=$data;
                }
            }
            $final_data[]=$procedureFinale;
        }
        $send_data['procedures']=$final_data;
        return view('institution.reports.all',$send_data);
    }

    public function studentWiseReport($id){
        if(!auth('institution')->user()){
            return redirect('/institution/login');
         }
        $user=Auth::guard('institution')->user();
        $studentDetails=Student::where('institution_id',$user->id)->where('id',$id)->where('active_status',1)->first();
        if(!$studentDetails){
            return redirect()->back()->withErrors(['error' => 'Student Not Found.']);

        }
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
                        ->where('student_id', $id)
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
        return view('institution.reports.student',$send_data);
    }
    
    
    public function PerformanceReport(){
         $user=auth('institution')->user();
         $student_ids = Student::where('institution_id',$user->id)->pluck('id')->toArray();
         $send_data['performances'] = ProcedureTrialMark::whereIn('student_id',$student_ids)->get();
         return view('institution.reports.performance',$send_data);
    }


}
