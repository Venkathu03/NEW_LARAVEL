<?php

namespace App\Http\Controllers\Student\Auth;

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

use App\Models\Announcements;
use Carbon\Carbon;


class DashboardController extends Controller
{
   public function Index(){
        if(!auth('student')->user()){
            return redirect('/student/login');
        }
        
       if(Auth::guard('student')->user() && Auth::guard('student')->user()->is_payment_done =="no"){
           return redirect('/student/pending-approval');
       }
       $user=Auth::guard('student')->user();
       $send_data['announcements'] = Announcements::where('institution_id',$user->institution_id)->whereDate('created_at', Carbon::today())->where('active_status',1)->get();
       
       $procedureTypes=ProcedureType::where('active_status',1)->get(['id','procedure_type_name']);
       $student_id = $user->id;
        $procedureTypes->map(function ($item, $key) use ($student_id) {
            $score = ProcedureTrialMark::where('student_id',$student_id)->where('procedure_type_id',$item->id)->get();
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
            $mark_list=ProcedureTrialMark::where('student_id',$user->id)->orderBy('id','desc')->take(10)->get();
            $mark_list->map(function ($item, $key) {
                $proceduredetails=Procedure::find($item->procedure_id);
                $proceduretypedetails=ProcedureType::find($item->procedure_type_id);
                $item->procedure_name=$proceduredetails->procedure_name;
                $item->procedure_type_name=$proceduretypedetails->procedure_type_name;
            });
            $send_data['recent_trials'] = $mark_list;
            $procedure_ids = ProcedureTrialMark::where('student_id', $student_id)->pluck('procedure_id')->toArray();
        

    
            $overall_performance=ProcedureType::where('procedure_type_name','Overall performance')->first('id');
            $procedures=Procedure::where('active_status',1)->get(['id','procedure_name','description','procedure_image']);
            if($overall_performance){
                $mark_list = ProcedureTrialMark::where('procedure_id', $procedures[0]->id)
                        ->where('procedure_type_id', $overall_performance->id)
                        ->where('student_id', $user->id)
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
       
       //dd($send_data['recent_procedures'] );
       
        return view('student.dashboard.index',$send_data);

    }
    
    public function FilterByType(Request $request){
          $user=Auth::guard('student')->user();
          $overall_performance=ProcedureType::where('procedure_type_name','Overall performance')->first('id');
            $procedures=Procedure::where('active_status',1)->get(['id','procedure_name']);
            if($overall_performance){
                $mark_list = ProcedureTrialMark::where('procedure_id', $request->id)
                        ->where('procedure_type_id', $overall_performance->id)
                        ->where('student_id', $user->id)
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
            $labels = ['Trail 1', 'Trail 2', 'Trail 3', 'Trail 4'];
            $data = [/* Process your data and populate the array */];

            return Response::json([
                'labels' => $labels,
                'data' => $mark_list,
            ]);

    }
    
    
    public function getOverallPerformance($procedure_id){
        $score = ProcedureTrialMark::where('student_id',auth('student')->user()->id)->where('procedure_id',$procedure_id)->get();
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

    public function PendingApproval(){
        if(!auth('student')->user()){
            return redirect('/student/login');
         }
       
        $data['sub_fee'] = SubscriptionFee::where('subscription_id',auth('student')->user()->subscription_id)->where('year',auth('student')->user()->study_year)->first();
        //dd($data['sub_fee']);
        return view('student.dashboard.pending_approval',$data);
    }
    
      public function paymentdetail(Request $request){
       
        $subscription = Subscription::where('course_id',$request->course_id)->where('passing_year',$request->pass_year)->first();
          //dd($subscription);
        if(!is_null($subscription)){
            $course =  Course::find($request->course_id);
            $currentDate = date('Y-m-d');
            $yearVariable = $request->pass_year;
            $yearTimestamp = strtotime($yearVariable . '-01-01');
           
            $diffYears = date('Y', $yearTimestamp) - date('Y', strtotime($currentDate));
            $new_diff = $diffYears +1;
            if($new_diff > $course->study_duration){

                return false;

            }
            $st_year = $course->study_duration - $diffYears;
            $sub_fee = SubscriptionFee::where('subscription_id',$subscription->id)->where('year',$st_year)->first();
            return !is_null($sub_fee) ? $sub_fee:0;
            
        }else{
             return "false";
        }
  
    }
    
     public function PaymentSuccess(Request $request){
         if(Auth::guard('student')->user() && Auth::guard('student')->user()->is_payment_done =="yes"){
             if(Session::get('payment-success')){
                 return view('student.success');
             }else{
                return redirect('/student/dashboard'); 
             }
        }else{
              return redirect('/student/pending-approval');
         }
     }
}
