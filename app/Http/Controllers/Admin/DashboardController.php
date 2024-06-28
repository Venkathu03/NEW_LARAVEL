<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstitutionMaster;
use App\Models\Student;
use App\Models\Procedure;
use App\Models\ProcedureType;
use App\Models\Subscription;
use App\Models\SubscriptionFee;
use App\Models\ProcedureTrialMark;
use Auth;
use Session;
use Carbon\Carbon;
use Response;
use DB;

class DashboardController extends Controller
{
    public function Index(){
     
       $procedureTypes=ProcedureType::where('active_status',1)->get(['id','procedure_type_name']);
       $total_student = Student::where('active_status',1)->count();
       $student_ids = Student::where('active_status',1)->pluck('id')->toArray();
       $total_institute = InstitutionMaster::where('active_status',1)->count();
       $is_registered_institute = InstitutionMaster::where('active_status',1)->where('is_registered','yes')->count();
       $un_registered_institute = InstitutionMaster::where('active_status',1)->where('is_registered','no')->count();
       $is_registered_percent =  ($is_registered_institute/$total_institute)*100;
       $un_registered_percent =  ($un_registered_institute/$total_institute)*100;
       $send_data['is_registered_institute'] =round($is_registered_percent);
       $send_data['un_registered_institute'] =round($un_registered_percent);
       $send_data['total_institution'] = InstitutionMaster::where('active_status',1)->count();
       $send_data['total_performance'] = ProcedureTrialMark::count();
       $send_data['today_performance'] = ProcedureTrialMark::whereDate('created_at', now()->toDateString())->count();

        $procedureTypes->map(function ($item, $key) {
            $score = ProcedureTrialMark::where('procedure_type_id',$item->id)->get();
            if ($score->isNotEmpty()) {
                $count = $score->count();
                $sum = $score->sum('score');
                $avg = $sum / $count;
                $item->avg =(int)$avg;
            } else {
                $item->avg = 0;
            }
        });
           $overall_avg = 0;
            foreach($procedureTypes as $type){
                $overall_avg += $type->avg; 
            }
          $no_of_procedure = count($procedureTypes);
          $percent = $overall_avg / $no_of_procedure;
          $send_data['overall_performace'] =round($percent);
          $send_data['procedure_types'] = $procedureTypes;
            $mark_list=ProcedureTrialMark::orderBy('id','desc')->take(10)->get();
            $mark_list->map(function ($item, $key) {
                $proceduredetails=Procedure::find($item->procedure_id);
                $proceduretypedetails=ProcedureType::find($item->procedure_type_id);
                $item->procedure_name=$proceduredetails->procedure_name;
                $item->procedure_type_name=$proceduretypedetails->procedure_type_name;
            });
            $send_data['recent_trials'] = $mark_list;
            $procedure_ids = ProcedureTrialMark::pluck('procedure_id')->toArray();
            $overall_performance=ProcedureType::where('procedure_type_name','Overall performance')->first('id');
            $procedures=Procedure::where('active_status',1)->get(['id','procedure_name','description','procedure_image']);
            if($overall_performance){
                $mark_list = ProcedureTrialMark::where('procedure_id', $procedures[0]->id)
                        ->where('procedure_type_id', $overall_performance->id)
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

            $send_data['score']=$mark_list;  
            $procedures_data = [];
                foreach($procedures as $procedure){
                    $procedureFinale=array();
                    $procedureFinale['procedure_name']=$procedure->procedure_name;
                    $procedureFinale['procedure_name']=$procedure->procedure_name;
                    $procedureFinale['description']=$procedure->description;
                    $procedureFinale['procedure_image']=$procedure->procedure_image;
                    $procedureFinale['created_at']=$procedure->created_at;
                    $procedureFinale['overall_performance']=$this->getOverallPerformance($procedure->id);
                    $procedures_data[]=$procedureFinale;
                }
        $send_data['procedures'] = $procedures;
        $send_data['recent_procedures'] = $procedures_data;
        $send_data['total_student'] = $total_student;
        
        // finding to score
            $top_mark_list=ProcedureTrialMark::whereIn('student_id',$student_ids)->orderBy('score','desc')->get();
            $data = [];
            foreach($top_mark_list as $mark) {
                $score=ProcedureTrialMark::where('student_id',$mark->student_id)->where('procedure_id',$mark->procedure_id)->get();
                if ($score->isNotEmpty()) {
                    $count = $score->count();
                    $sum = $score->sum('score');
                    $avg = $sum / $count;
                    $avg =(int)$avg;
                } else {
                    $avg = 0;
                }
                $data['avg'] = $avg;
                $data['score'] = $mark->score;
                $data['student_name'] = $mark->student->fullname;
                $data['procedure_name'] = $mark->procedure->procedure_name;
                $data['procedure_type_name'] = $mark->proceduretype->procedure_type_name;
                $final_data[] = $data;
            }
        
            $topStudents = DB::table('students'
            )->join(DB::raw('(SELECT student_id, AVG(score) as score FROM procedure_trial_marks GROUP BY student_id ORDER BY AVG(score) LIMIT 5) as top_scorer'), function($join) {
                $join->on('top_scorer.student_id', '=','students.id');
            })
            ->select(['students.*', 'top_scorer.score']) //Select fields you need.
            ->where('students.active_status',1)
            ->orderBy('top_scorer.score','desc')
            ->get();
        
        
        $topInstitutions = DB::table('students'
        )->join(DB::raw('(SELECT student_id, AVG(score) as score FROM procedure_trial_marks GROUP BY student_id ORDER BY AVG(score) LIMIT 5) as top_scorer'), function($join) {
            $join->on('top_scorer.student_id', '=','students.id');
        })->leftjoin('institution_masters', 'students.institution_id', '=', 'institution_masters.id')
        ->select(['top_scorer.score','institution_masters.*'])
        ->where('students.active_status',1)
        ->orderBy('top_scorer.score','desc')
        ->get();
        
        $month = date('Y-m');
        $records = ProcedureTrialMark::where('created_at', 'LIKE','%'.$month. '%')->get();
        
        $groupedRecords = $records->groupBy(function ($record) {
             return Carbon::parse($record->created_at)->ceilWeek()->format('d-m-Y')
                .'-'.Carbon::parse($record->created_at)->floorWeek()->format('d-m-Y');
            //return $record->created_at->format('W');
        });
       
        $data =[]; 
        $final_data1 = [];
        $mark_list = array();
        $labels = array();
        $cnt = 1;
        foreach($groupedRecords as $key=>$record){
            $count = $record->count('score');
            if ($count > 0) {
                    $sum = $record->sum('score');
                    $avg = $sum / $count;
                    $avg =(int)$avg;
            } else {
                    $avg = 0;
            }
            $mark_list[] = $avg;
            $cnt++;
        }
        
         $count = count($mark_list);

            if ($count < 4) {
                $missingValuesCount = 4 - $count;
                $zeroValues = array_fill(0, $missingValuesCount, 0);
                $mark_list = array_merge($zeroValues,$mark_list);
            }
            $mark_list = collect($mark_list)->map(function ($value) {
                return is_numeric($value) ? (int)$value : 0;
            });
       
        for($i=1;$i<=count($mark_list);$i++){
           $labels[] = 'Week '.$i;
        }
        
        $send_data['week_score']=$mark_list;
        $send_data['weeks']=$labels;
        $send_data['top_students'] = $topStudents;
        $send_data['top_institutions'] = $topInstitutions;
        return view('admin.dashboard.index',$send_data);
    }
    
      public function getOverallPerformance($procedure_id){
        $score = ProcedureTrialMark::where('procedure_id',$procedure_id)->get();
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
        
          return round($percent).'%';    
        
    }
    
    public function adminLogout(Request $request){
        \Auth::guard('admin')->logout();

        
        $request->session()->invalidate();

        $request->session()->regenerateToken();

      

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/admin/login');
    }
    
    
    
    public function FilterByMonth(Request $request){
        
        $month = $request->month;
        $date = $request->month.'01';
        
        $records = ProcedureTrialMark::where('created_at', 'LIKE','%'.$month. '%')->get();
        
        $groupedRecords = $records->groupBy(function ($record) {
             return Carbon::parse($record->created_at)->ceilWeek()->format('d-m-Y')
                .'-'.Carbon::parse($record->created_at)->floorWeek()->format('d-m-Y');
            //return $record->created_at->format('W');
        });
       
        $data =[]; 
        $final_data1 = [];
        $mark_list = array();
        $labels = array();
        $cnt = 1;
        foreach($groupedRecords as $key=>$record){
            $count = $record->count('score');
            if ($count > 0) {
                    $sum = $record->sum('score');
                    $avg = $sum / $count;
                    $avg =(int)$avg;
            } else {
                    $avg = 0;
            }
            $mark_list[] = $avg;
            $cnt++;
        }
        
         $count = count($mark_list);

            if ($count < 4) {
                $missingValuesCount = 4 - $count;
                $zeroValues = array_fill(0, $missingValuesCount, 0);
                $mark_list = array_merge($zeroValues,$mark_list);
            }
            $mark_list = collect($mark_list)->map(function ($value) {
                return is_numeric($value) ? (int)$value : 0;
            });
       
        for($i=1;$i<=count($mark_list);$i++){
           $labels[] = 'Week '.$i;
        }
         //dd($labels);
        
        //$labels= ['Week 1','Week 2','Week 3','Week 4'];
        return Response::json([
                'labels' => $labels,
                'data' => $mark_list,
            ]);

    }
    
   
}
