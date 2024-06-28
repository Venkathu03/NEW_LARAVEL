<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\Course;
use App\Models\InstitutionMaster;
use App\Models\SubscriptionFee;
use DB;

class SubscriptionController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $send_data['subscriptions'] = Subscription::where('active_status','!=',3)->get();
        $send_data['institutions'] = InstitutionMaster::where('active_status',1)->get();
        $send_data['courses'] = Course::where('active_status',1)->get();
        return view('admin.master.subscription.index',$send_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $send_data['institutions'] = InstitutionMaster::where('active_status',1)->get();
        $send_data['courses'] = Course::where('active_status',1)->get();
        return view('admin.master.subscription.add',$send_data);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subscription = Subscription::where('institution_id',$request->institution_id)->where('course_id',$request->course_id)->first();
        if(!is_null($subscription)){
            return redirect()->back()->withErrors('Subscription Already Exist.');
        }
        $subscription = new Subscription;
        $subscription->institution_id = $request->institution_id;
        $subscription->course_id = $request->course_id;
        $subscription->course_start_at = $request->course_start_at;
         $subscription->course_end_at = $request->course_end_at;
        $subscription->fees = $request->fees;
        if($subscription->save()){
             if(isset($request->study_duration)){
                foreach($request->study_duration as $key=>$duration){
                    $sub = new SubscriptionFee;
                    $sub->subscription_id = $subscription->id;
                    $sub->year = $key+1;
                    $sub->fees = $duration;
                    $sub->save();
                }
           }
        }
        return redirect()->back()->with('success','Record saved successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscription = Subscription::find($id);
        $course_ids = Subscription::where("institution_id",$subscription->institution_id)->pluck("course_id")->toArray(); 
        $send_data['institutions'] = InstitutionMaster::where('active_status',1)->get();
        $send_data['courses'] = Course::where('active_status',1)->get();
        $send_data['subscription_fees'] = SubscriptionFee::where('subscription_id',$id)->get();
        $send_data['subscription'] = $subscription;
        return view('admin.master.subscription.edit',$send_data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subscription = Subscription::where('institution_id',$request->institution_id)->where('course_id',$request->course_id)->first();
        if(isset($subscription) && $subscription->id !=$id){
            return redirect()->back()->withErrors('Subscription Detail Already Exist.');
        }
        $subscription = Subscription::find($id);
        $subscription->institution_id = $request->institution_id;
        $subscription->course_id = $request->course_id;
        $subscription->course_start_at = $request->course_start_at;
        $subscription->course_end_at = $request->course_end_at;
        $subscription->fees = $request->fees;
        $subscription->active_status = $request->active_status;
        if($subscription->save()){
            DB::table('subscription_fees')->where('subscription_id',$subscription->id)->delete();
            if(isset($request->study_duration)){
                foreach($request->study_duration as $key=>$duration){
                    if(!is_null($duration)){
                        $sub = new SubscriptionFee;
                        $sub->subscription_id = $subscription->id;
                        $sub->year = $key+1;
                        $sub->fees = $duration;
                        $sub->save();
                    }
                }
            }
        }
        return redirect()->back()->with('success','Record Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
    {
        $type= Subscription::find($id);
        $type->active_status=3;
        $type->save();        
        return redirect()->back()->with(['success'=>'Record deleted successfully.']);
    }
    
    
    public function ShowYearFee(Request $request){
        $send_data['course'] = Course::find($request->id);
        return view('admin.master.subscription.show_fee',$send_data);
    }
    
    public function checkSubscription(Request $request){
          $subscription =  Subscription::where('institution_id',$request->institution_id)->where("course_id",$request->course_id)->where("passing_year",$request->passing_year)->first(); 
            if(!is_null($subscription)){
                $status = "true";
            }else{
                $status = "false";
            }
        return $status;
    }
}
