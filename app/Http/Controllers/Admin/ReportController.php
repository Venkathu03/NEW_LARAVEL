<?php

namespace App\Http\Controllers\Admin;

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
use DateTime;
use DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function index(){
  
        $send_data['student_lists']=Student::where('active_status',1)->get();
        
        $send_data['register_institions'] = InstitutionMaster::where("is_registered","yes")->where('active_status','!=',3)->get();
        $send_data['unregister_institions'] = InstitutionMaster::where("is_registered","no")->where('active_status','!=',3)->get();
        
        $send_data['all_institutions'] = InstitutionMaster::where('active_status',1)->get();
        
        $student_list=Student::pluck('id')->toArray();
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
                    $data['procedure_type_name']=$procedureTypeDetails->procedure_type_name;
                    $data['score'][0]=$avg;
                    $procedureFinale['type_value'][]=$data;
                }
            }
            $final_data[]=$procedureFinale;
        }
        $send_data['procedures']=$final_data;
        return view('admin.report.performance',$send_data);
    }
    
    
    
    public function FilterByStudent(Request $request){
        
        $student_id = $request->student_id;
        $institution_id= $request->institution_id;
        $send_data['student_lists']=Student::where('active_status',1)->get();
        $student_list=Student::pluck('id')->toArray();
        $final_data=array();
        $procedures=Procedure::where('active_status',1)->get();
        foreach($procedures as $procedure){
            $procedureFinale=array();
            $procedureFinale['procedure_name']=$procedure->procedure_name;
            $procedure_Type=explode(',',$procedure->procedure_type_id);
            foreach($procedure_Type as $pro_type){
                 $procedureTypeDetails=ProcedureType::where('id',$pro_type)->where('active_status',1)->pluck('procedure_type_name')->first();
                $procedures=Procedure::where('active_status',1)->get(['id','procedure_name','description','procedure_image']);
                        if($procedures){
                            
                            if(!is_null($request->institution_id)){
                              
                                $student_list=Student::where('institution_id',$request->institution_id)->pluck('id')->toArray();
                             
                                if(!is_null($request->from_date) &&  is_null($request->to_date) && !is_null($student_id)){
                                $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                    ->where('procedure_type_id',$pro_type)
                                    ->where('student_id', $student_id)->whereDate('created_at',$request->from_date)
                                    ->orderBy('id', 'desc')
                                    ->take(4)
                                    ->pluck('score');  
                                } elseif(!is_null($request->from_date) &&  !is_null($request->to_date) && !is_null($student_id)){ //whereBetween
                                  $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                        ->where('procedure_type_id',$pro_type)
                                         ->where('student_id', $student_id)->whereBetween('created_at',[$request->from_date,$request->to_date])
                                        ->orderBy('id', 'desc')
                                        ->take(4)
                                        ->pluck('score');  

                                } elseif(!is_null($request->from_date) &&  !is_null($request->to_date) && is_null($student_id)){
                                     $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                        ->where('procedure_type_id',$pro_type)
                                        ->whereBetween('created_at',[$request->from_date,$request->to_date])
                                        ->whereIn('student_id', $student_list)
                                        ->orderBy('id', 'desc')
                                        ->take(4)
                                        ->pluck('score'); 
                                }
                                elseif(is_null($request->from_date) &&  is_null($request->to_date) && !is_null($student_id)){
                                     $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                        ->where('procedure_type_id',$pro_type)
                                        ->where('student_id', $student_id)
                                        ->orderBy('id', 'desc')
                                        ->take(4)
                                        ->pluck('score'); 
                                }
                                
                                else{
                                 $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                        ->where('procedure_type_id',$pro_type)
                                        ->whereIn('student_id', $student_list)
                                        ->orderBy('id', 'desc')
                                        ->take(4)
                                        ->pluck('score');  
                                }
                                
                            } else{
                                if(!is_null($request->from_date) &&  is_null($request->to_date) && !is_null($student_id)){
                                $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                    ->where('procedure_type_id',$pro_type)
                                    ->where('student_id', $student_id)->whereDate('created_at',$request->from_date)
                                    ->orderBy('id', 'desc')
                                    ->take(4)
                                    ->pluck('score');  
                                } elseif(!is_null($request->from_date) &&  !is_null($request->to_date) && !is_null($student_id)){ //whereBetween
                                  $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                        ->where('procedure_type_id',$pro_type)
                                         ->where('student_id', $student_id)->whereBetween('created_at',[$request->from_date,$request->to_date])
                                        ->orderBy('id', 'desc')
                                        ->take(4)
                                        ->pluck('score');  

                                } elseif(!is_null($request->from_date) &&  !is_null($request->to_date) && is_null($student_id)){
                                     $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                        ->where('procedure_type_id',$pro_type)
                                        ->whereBetween('created_at',[$request->from_date,$request->to_date])
                                        ->orderBy('id', 'desc')
                                        ->take(4)
                                        ->pluck('score'); 
                                } else{
                                 $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                        ->where('procedure_type_id',$pro_type)
                                        ->where('student_id', $student_id)
                                        ->orderBy('id', 'desc')
                                        ->take(4)
                                        ->pluck('score');  
                                }
                            
                            }
                           
                            
                        }else{
                            $mark_list=array();
                        }
                      $count = $mark_list->count();

                        if ($count < 4) {
                            $missingValuesCount = 4 - $count;
                            $zeroValues = array_fill(0, $missingValuesCount, 0);
                            $mark_list = array_merge($mark_list->toArray(),$zeroValues);
                        }
                        $mark_list = collect($mark_list)->map(function ($value) {
                            return is_numeric($value) ? (int)$value : 0;
                        });
               
                $procedureFinale['procedure_type_name']=$procedureTypeDetails;
                $procedureFinale['score'] = $mark_list;
                $procedureFinale['type_value'][]=$procedureFinale;
            }
            $final_data[]=$procedureFinale;
        }
        $send_data['procedures']=$final_data;
        return view('admin.report.filter_student_report',$send_data)->render();
    }
    
    
    public function InstitutionReportView($id){
        
      $send_data['instition'] = InstitutionMaster::find($id);
        
       $send_data['student_lists']=Student::where('institution_id',$id)->where('active_status',1)->get();
        $student_list=Student::where('institution_id',$id)->pluck('id')->toArray();
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
                    $data['procedure_type_name']=$procedureTypeDetails->procedure_type_name;
                    $data['score'][0]=$avg;
                    $procedureFinale['type_value'][]=$data;
                }
            }
            $final_data[]=$procedureFinale;
        }
         $student_ids=Student::where('institution_id',$id)->where('active_status',1)->pluck('id')->toArray();
     
         $mark_list=Student::whereIn('id',$student_ids)->orderBy('id','desc')->take(10)->get();
            $mark_list->map(function ($item, $key) {
                $score = ProcedureTrialMark::where('student_id',$item->id)->get();
                $monthNum  = date('m');
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                $item->student_name=$item->fullname;
                $item->mobile=$item->phone_number;
                $item->course_name=$item->course->course_name;
                $item->month =  $dateObj->format('F');  
                if ($score->isNotEmpty()) {
                    $count = $score->count();
                    $sum = $score->sum('score');
                    $avg = $sum / $count;
                    $item->avg =(int)$avg;
                } else {
                    $item->avg = 0;
                }
                
            });
            $send_data['current_month'] = date('m');
            $send_data['current_month_report'] = $mark_list;
            $send_data['procedures']=$final_data;
            return view('admin.report.view_institution',$send_data);  
    }
    
    
    
    public function FilterByProcedure(Request $request){
        $user_id =$request->institution_id; 
        $student_ids = Student::where('institution_id',$user_id)->pluck('id')->toArray();
        $top_mark_list=ProcedureTrialMark::whereIn('student_id',$student_ids)->where('procedure_id',$request->id)->get();
        $student_ids=ProcedureTrialMark::where('procedure_id',$request->id)->pluck('student_id')->toArray();
        
        if(!is_null($request->id)) {
              
            $topStudents = DB::table('students'
            )->join(DB::raw('(SELECT student_id, AVG(score) as score FROM procedure_trial_marks GROUP BY student_id ORDER BY AVG(score) LIMIT 5) as top_scorer'), function($join) {
                $join->on('top_scorer.student_id', '=','students.id');
            })
            ->select(['students.*', 'top_scorer.score']) //Select fields you need.
            ->where('students.institution_id',$user_id)
            ->whereIn('students.id',$student_ids)  
            ->where('students.active_status',1)
            ->orderBy('top_scorer.score','desc')
            ->get();
            
            
        }else{
            $topStudents = DB::table('students'
            )->join(DB::raw('(SELECT student_id, AVG(score) as score FROM procedure_trial_marks GROUP BY student_id ORDER BY AVG(score) LIMIT 5) as top_scorer'), function($join) {
                $join->on('top_scorer.student_id', '=','students.id');
            })
            ->select(['students.*', 'top_scorer.score']) //Select fields you need.
            ->where('students.institution_id',$user_id)
            ->where('students.active_status',1)
            ->orderBy('top_scorer.score','desc')
            ->get();
        }
         $send_data['top_students'] = $topStudents;
         return view('admin.report.top_five_filter',$send_data);
    }
    
    public function getStudent(Request $request){
         $send_data['students'] = Student::where('institution_id',$request->id)->where('active_status',1)->get();
         return view('admin.report.student_dropdown',$send_data);
        
    }
    
    
    
}
