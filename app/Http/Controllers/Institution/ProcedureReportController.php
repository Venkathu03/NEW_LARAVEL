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
use DateTime;
use DB;
use Carbon\Carbon;

class ProcedureReportController extends Controller
{
    public function Index(){
        if(!auth('institution')->user()){
            return redirect('/institution/login');
         }
        $user=Auth::guard('institution')->user();
        $send_data['student_lists']=Student::where('institution_id',$user->id)->where('active_status',1)->get();
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
                    $data['procedure_type_name']=$procedureTypeDetails->procedure_type_name;
                    $data['score'][0]=$avg;
                    $procedureFinale['type_value'][]=$data;
                }
            }
            $final_data[]=$procedureFinale;
        }
         $student_ids=Student::where('institution_id',$user->id)->where('active_status',1)->pluck('id')->toArray();
     
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
        
           return view('institution.reports.student_performance',$send_data);
    }
    
    
    public function FilterByStudent(Request $request){
        
        $id = $request->id;
        $user=Auth::guard('institution')->user();
        $send_data['student_lists']=Student::where('institution_id',$user->id)->where('active_status',1)->get();
        $student_list=Student::where('institution_id',$user->id)->pluck('id')->toArray();
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
                            if(!is_null($request->from_date) &&  is_null($request->to_date) && !is_null($id)){
                                $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                    ->where('procedure_type_id',$pro_type)
                                    ->where('student_id', $id)->whereDate('created_at',$request->from_date)
                                    ->orderBy('id', 'desc')
                                    ->take(4)
                                    ->pluck('score');  
                            }elseif(!is_null($request->from_date) &&  !is_null($request->to_date) && !is_null($id)){ //whereBetween
                              $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                    ->where('procedure_type_id',$pro_type)
                                     ->where('student_id', $id)->whereBetween('created_at',[$request->from_date,$request->to_date])
                                    ->orderBy('id', 'desc')
                                    ->take(4)
                                    ->pluck('score');  
                                
                            }elseif(!is_null($request->from_date) &&  !is_null($request->to_date) && is_null($id)){
                                 $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                    ->where('procedure_type_id',$pro_type)
                                    ->whereBetween('created_at',[$request->from_date,$request->to_date])
                                    ->orderBy('id', 'desc')
                                    ->take(4)
                                    ->pluck('score'); 
                            }else{
                             $mark_list = ProcedureTrialMark::where('procedure_id', $procedure->id)
                                    ->where('procedure_type_id',$pro_type)
                                    ->where('student_id', $id)
                                    ->orderBy('id', 'desc')
                                    ->take(4)
                                    ->pluck('score');  
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
        return view('institution.reports.filter_student_report',$send_data);
    }
    
    public function FilterMonthReport(Request $request){
        
        $user=Auth::guard('institution')->user();
        $student_ids=Student::where('institution_id',$user->id)->where('active_status',1)->pluck('id')->toArray();
     
        if(!is_null($request->student_id) && is_null($request->month)){
              $mark_list=Student::where('id',$request->student_id)->orderBy('id','desc')->get();
                $mark_list->map(function ($item, $key) {
                    $score = ProcedureTrialMark::where('student_id',$item->id)->get();
                    $monthNum  = date('m',$score->created_at);
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
        }elseif(!is_null($request->student_id) && !is_null($request->month)){
           
            $mark_list=Student::where('id',$request->student_id)->orderBy('id','desc')->get();
             $month =$request->month;
             $student_id =$request->student_id;
                $mark_list->map(function ($item, $key)  use($month,$student_id) {
                   
                    $score = ProcedureTrialMark::where('student_id',$student_id)->whereMonth('created_at',$month)->get();
                    $monthNum  =$month;
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
        }elseif(is_null($request->student_id) && !is_null($request->month)){
            $mark_list=Student::whereIn('id',$student_ids)->orderBy('id','desc')->get();
            
                $month =$request->month;
                $mark_list->map(function ($item, $key)  use($month){
                    $score = ProcedureTrialMark::where('student_id',$item->id)->whereMonth('created_at',$month)->get();
                    $monthNum  = $month;
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
        }else{
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
        }
         $send_data['current_month_report'] = $mark_list;
         return view('institution.reports.month_filter_report',$send_data);
        
    }
    
    public function ViewMonthReport($id, $month)
    {
        $student = Student::where('id', $id)->where('active_status', 1)->first();
        $send_data['student_detail'] = $student;
        $parsedMonth = Carbon::parse($month);
        $mark_lists = ProcedureTrialMark::where('student_id', $id)
            ->whereMonth('created_at', $parsedMonth->month)
            ->get();
    
        $groupedData = [];
    
        // Group marks by procedure
        foreach ($mark_lists as $mark) {
            $procedureName = $mark->procedure->procedure_name;
            $procedureTypeName = $mark->proceduretype->procedure_type_name;
    
            if (!isset($groupedData[$procedureName])) {
                $groupedData[$procedureName] = [
                    'total_score' => 0,
                    'count' => 0,
                    'trials' => 0,
                    'total_time' => 0,
                    'time_count' => 0,
                    'month' => Carbon::parse($mark->created_at)->format('M')
                ];
            }
    
            $groupedData[$procedureName]['total_score'] += $mark->score;
            $groupedData[$procedureName]['count']++;
            $groupedData[$procedureName]['trials']++;
    
            if ($procedureTypeName === "Timetaken / 60s") {
                $groupedData[$procedureName]['total_time'] += $mark->score;
                $groupedData[$procedureName]['time_count']++;
            }
        }
    
        $combinedData = [];

    
        // Calculate average score and prepare the combined data
        foreach ($groupedData as $procedureName => $data) {
            $averageScore = $data['total_score'] / $data['count'];
            $averageTimeTaken = $data['time_count'] > 0 ? round($data['total_time'] / $data['time_count'], 2) . ' min' : null;
    
            $combinedData[] = [
                'month' => $data['month'],
                'score' => round($averageScore, 2),
                'procedure_name' => $procedureName,
                'trials' => $data['trials'],
                'time_taken' => $averageTimeTaken
            ];
        }
    
        $send_data['combined_data'] = $combinedData;
    
        return view('institution.reports.view_report', $send_data);
    }
    public function ViewMonthReportProcedureWise($id, $month, $procedure_name)
    {
        $student = Student::where('id', $id)->where('active_status', 1)->first();
        $send_data['student_detail'] = $student;
        $parsedMonth = Carbon::parse($month);
        $proce_id = Procedure::where('procedure_name', $procedure_name)->pluck('id');
        $mark_lists_pro = ProcedureTrialMark::where('student_id', $id)
            ->whereMonth('created_at', $parsedMonth->month)
            ->where('procedure_id', $proce_id)
            ->get();
        $pro_type_count = $procedure_type_count = Procedure::where('procedure_name', $procedure_name)
        ->pluck('procedure_type_id')->first();
        $pro_types_array = explode(',', $pro_type_count);
        $procedure_type_count = count($pro_types_array);
            $data = [];
            $final_data = [];
            foreach($mark_lists_pro as $mark) {
                $data['month'] = Carbon::parse($mark->created_at)->format('M');
                $trail_counts= ProcedureTrialMark::where('student_id',$id)->whereMonth('created_at',Carbon::parse($mark->created_at)->format('m'))
                ->where('procedure_id', $proce_id)->count();
                $data['trail'] = $trail_counts/$procedure_type_count;
                $data['type_count'] = $procedure_type_count;
                $data['score'] = $mark->score;
                $data['procedure_name'] = $mark->procedure->procedure_name;
                $data['procedure_type_name'] = $mark->proceduretype->procedure_type_name;
                $final_data[] = $data;
            }
              $send_data['mark_lists']=$final_data;
            
            return view('institution.reports.view_report_procedurewise',$send_data);
    }
    
}
