<?php

namespace App\Http\Controllers\Institution\Auth;

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
use DB;

class DashboardController extends Controller
{
    public function Index(){
     if(!auth('institution')->user()){
            return redirect('/institution/login');
        }
       $user=auth('institution')->user();
       $procedureTypes=ProcedureType::where('active_status',1)->get(['id','procedure_type_name']);
       $student_ids = Student::where('institution_id',$user->id)->where('active_status',1)->pluck('id')->toArray();
       $student_count = Student::where('institution_id',$user->id)->pluck('id')->count();
        
       $today_performance = ProcedureTrialMark::whereIn('student_id',$student_ids)->whereDate('created_at', Carbon::today())->count();
    //    $total_performance = ProcedureTrialMark::whereIn('student_id',$student_ids)->count();
       $total_performance = ProcedureTrialMark::whereIn('student_id', $student_ids)->where('procedure_type_id', 8)->avg('score');
       $total_performance_by_student = round($total_performance, 2);
       $paid_student = Student::whereIn('id',$student_ids)->where('is_payment_done','yes')->count();
        
        $procedureTypes->map(function ($item, $key) use ($student_ids) {
            $score = ProcedureTrialMark::whereIn('student_id',$student_ids)->where('procedure_type_id', $item->id)->get();
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
         
            $send_data['total_student'] = $student_count;
            $send_data['today_performance'] = $today_performance;
            $send_data['total_performance'] = $total_performance_by_student;
            $send_data['paid_student'] =  $paid_student;
        
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
                $data['course_name'] = $mark->student->course->course_name;
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
        ->where('students.institution_id',$user->id)
        ->where('students.active_status',1)
        ->orderBy('top_scorer.score','desc')
        ->get();
         $send_data['top_students'] = $topStudents;
         $send_data['procedures'] =Procedure::where('active_status',1)->get(['id','procedure_name']);
        //  $send_data['batch_year'] = Student::where('institution_id', $user->id)->get(['batch_year', 'batch_year']); //Newly Added
        $send_data['batch_year'] = Student::where('institution_id', $user->id)->distinct()->pluck('batch_year');
         return view('institution.dashboard.index',$send_data);
    }

    // New Function (14.05.2024)

    public function FilterByBatchYear(Request $request)
    {
        try {
            $user = auth('institution')->user();
            $batch = $request->input('batch');
            if (!is_null($batch)) {
                $student_ids_batchwise = Student::where('institution_id', $user->id)
                    ->where('active_status', 1)
                    ->where('batch_year', $batch)
                    ->pluck('id')
                    ->toArray();
            } else {
                $student_ids_batchwise = Student::where('institution_id', $user->id)
                    ->where('active_status', 1)
                    ->pluck('id')
                    ->toArray();
            }
            $total_performances = ProcedureTrialMark::whereIn('student_id', $student_ids_batchwise)
                ->where('procedure_type_id', 8)
                ->avg('score');
            $total_performance = round($total_performances, 2);
            return response()->json(['total_performances' => $total_performance], 200);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    //Ends Here

     // New Function (28.05.2024)

     public function FilterByBatchYearTotalStudents(Request $request)
     {
         try {
             $user = auth('institution')->user();
             $batch = $request->input('batch');
             if (!is_null($batch)) {
                 $student_ids_batchwise_count = Student::where('institution_id', $user->id)
                     ->where('active_status', 1)
                     ->where('batch_year', $batch)
                     ->pluck('id')
                     ->count();
             } else {
                 $student_ids_batchwise_count = Student::where('institution_id', $user->id)
                     ->where('active_status', 1)
                     ->pluck('id')
                     ->count();
             }
             return response()->json(['total_performances' => $student_ids_batchwise_count], 200);
         } catch (\Exception $e) {
             \Log::error($e->getMessage());
             return response()->json(['error' => 'Internal Server Error'], 500);
         }
     }
 
     //Ends Here

    // New Function (17-05-2024)

    public function FilterByProcedureProgress(Request $request)
    {
        try {
            $user = auth('institution')->user();
            $batch = $request->input('batch');
    
            // Validate the batch input
            if (!$batch) {
                $student_ids_batch = Student::where('institution_id', $user->id)
                ->where('active_status', 1)
                ->pluck('id')
                ->toArray();
            }
            else {
            $student_ids_batch = Student::where('institution_id', $user->id)
                                        ->where('active_status', 1)
                                        ->where('batch_year', $batch)
                                        ->pluck('id')
                                        ->toArray();
            }
            if (empty($student_ids_batch)) {
                return response()->json(['error' => 'No students found for the given batch year'], 404);
            }
    
            $procedureTypes = ProcedureType::where('active_status', 1)
                                           ->get(['id', 'procedure_type_name']);
    
            $procedureTypes->map(function ($item) use ($student_ids_batch) {
                $score = ProcedureTrialMark::whereIn('student_id', $student_ids_batch)
                                           ->where('procedure_type_id', $item->id)
                                           ->get();
                if ($score->isNotEmpty()) {
                    $count = $score->count();
                    $sum = $score->sum('score');
                    $avg = $sum / $count;
                    $item->avg = (int) $avg;
                } else {
                    $item->avg = 0;
                }
            });
    
            $overall_avg = 0;
            foreach ($procedureTypes as $type) {
                $overall_avg += $type->avg;
            }
            $no_of_procedure = count($procedureTypes);
            $percent = $overall_avg / $no_of_procedure;
            $send_data['overall_performace'] = round($percent);
            $send_data['procedure_types'] = $procedureTypes;
    
            // Return JSON response
            return response()->json($send_data);
    
        } catch (\Exception $e) {
            \Log::error('Error in FilterByProcedureProgress: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while processing the request.'], 500);
        }
    }
    
    
    // Ends Here

    
    public function FilterByProcedure(Request $request){
        $user=auth('institution')->user(); 
        $student_ids = Student::where('institution_id',$user->id)->pluck('id')->toArray();
        $top_mark_list=ProcedureTrialMark::whereIn('student_id',$student_ids)->where('procedure_id',$request->id)->get();
          
//        $data = [];
//        $final_data = [];
//            foreach($top_mark_list as $mark) {
//                $score=ProcedureTrialMark::where('student_id',$mark->student_id)->where('procedure_id',$request->id)->get();
//                if ($score->isNotEmpty()) {
//                    $count = $score->count();
//                    $sum = $score->sum('score');
//                    $avg = $sum / $count;
//                    $avg =(int)$avg;
//                } else {
//                    $avg = 0;
//                }
//                $data['avg'] = $avg;
//                $data['score'] = $mark->score;
//                $data['course_name'] = $mark->student->course->course_name;
//                $data['student_name'] = $mark->student->fullname;
//                $data['procedure_name'] = $mark->procedure->procedure_name;
//                $data['procedure_type_name'] = $mark->proceduretype->procedure_type_name;
//                $final_data[] = $data;
//            }
        
        $student_ids=ProcedureTrialMark::where('procedure_id',$request->id)->pluck('student_id')->toArray();
        
        if(!is_null($request->id)) {
              
            $topStudents = DB::table('students'
            )->join(DB::raw('(SELECT student_id, AVG(score) as score FROM procedure_trial_marks GROUP BY student_id ORDER BY AVG(score) LIMIT 5) as top_scorer'), function($join) {
                $join->on('top_scorer.student_id', '=','students.id');
            })
            ->select(['students.*', 'top_scorer.score']) //Select fields you need.
            ->where('students.institution_id',$user->id)
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
            ->where('students.institution_id',$user->id)
            ->where('students.active_status',1)
            ->orderBy('top_scorer.score','desc')
            ->get();
        }
         $send_data['top_students'] = $topStudents;
         return view('institution.dashboard.top_five_filter',$send_data);
    }
    
    public function institutionLogout(Request $request){
        \Auth::guard('institution')->logout();

        
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/institution/login');
    }
}
