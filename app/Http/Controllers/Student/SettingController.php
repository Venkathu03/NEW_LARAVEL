<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\Payment;
use App\Models\SubscriptionFee;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function Profile(){
        $user = auth('student')->user();
        $send_data['student'] =$user;
        $send_data['payments'] = Payment::where('student_id',auth('student')->user()->id)->get();
        $subscription_fee = SubscriptionFee::where('subscription_id',$user->subscription_id)->where('year',$user->study_year)->first();
        
      
        $send_data['subscription_fee'] = !is_null($subscription_fee) ? $subscription_fee->fees :0;
        
        $send_data['subscription_end_at'] = !is_null($subscription_fee) ? date('F Y', strtotime($subscription_fee->created_at->addYear(1))) :0;

        return view('student.setting.profile',$send_data);
    }
    
    public function UpdatePassword(Request $request){
        $student = auth('student')->user();
        if (Hash::check($request->current_password, auth('student')->user()->password)) {
          
            $student->password = Hash::make($request->password);
            $student->save();
            return redirect()->back()->with(['update-password'=>'Password has been updated','password-sec'=>'password-sec']);
         }else{
             return redirect()->back()->with(['error-password'=>'Curret Password does not matched','password-sec'=>'password-sec']);
        }
    }
    
    public function UpdateProfile(Request $request){
        
          $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust rules as needed.
          ]);

            if ($validator->fails()) {
                 return redirect()->back()->with(['error-profile'=>'File Should be jpg,png','profile-sec'=>'profile-sec']);
            }
     
         $student = auth('student')->user();
         if(isset($request->image)){
                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('/setting'), $imageName);
                $student->avatar = $imageName;
              $student->save();
              return redirect()->back()->with(['update-profile'=>'Profile Image has been updated','profile-sec'=>'profile-sec']);
        }else{
              return redirect()->back()->with(['error-profile'=>'Profile Image not updated','profile-sec'=>'profile-sec']);
             
         }
         
    }
}
