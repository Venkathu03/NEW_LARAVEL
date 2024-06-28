<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\InstitutionMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Mail;
use Session;
use Razorpay\Api\Api;
use App\Models\Subscription;
use Str;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:student')->except('logout');
    }

    public function showAdminLoginForm()
    {
      
        return view('student.auth.login', ['url' => route('student.login-view'), 'title'=>'Student Login']);
    }

    public function showStudentSignUpForm(){
        $send_data['institutions'] = InstitutionMaster::where('active_status',1)->get();
        $send_data['courses'] = Course::all();
        return view('student.auth.register',$send_data);
    }

    public function StoreStudent(Request $request){
        
        $subscription = Subscription::where('institution_id',$request->institution_id)->where('course_id',$request->course_id)->first();
        
        
        if(is_null($subscription)){
              return redirect()->back()->with('error','No Subscription Found.');
        }
        $student = Student::where('email',$request->email)->orwhere('phone_number',$request->phone_number)->first();
        if(!is_null($student)){
              return redirect()->back()->with('error','Email or Mobile number already exist.');
        }
        $institution = InstitutionMaster::find($request->institution_id);
        $currentDateTime = Carbon::now();
        $otp_expire_time = Carbon::now()->addMinute(5);

        $student = new Student;
        $student->fullname = $request->fullname;
        $student->phone_number = $request->phone_number;
        $student->email = $request->email;
        $student->password = Hash::make($request->password);
        $student->institution_id = $request->institution_id;
        $student->active_status = 0;
        $student->course_id = $request->course_id;
        $student->year_level = $request->study_year;
        $student->study_year = $request->study_year;
        $student->enrollment_year = date('Y');
        $student->batch_year = $request->batch_year;
        $student->is_registered = "no";
        $student->otp = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $student->otp_type = 'signup';
        $student->otp_expiry =$otp_expire_time;
        if($student->save()){
             $student->course_start_date =  $subscription->course_start_at;
             $student->course_end_date  = $subscription->course_end_at;
             $student->subscription_id  = $subscription->id;
             $student->save();
            
        send_sms($student->phone_number,$student->otp);
            
    //            Mail::send('email.otp', ['email' => $student->email,'otp'=>$student->otp], function ($message) use ($student) {
    //                $message->to($student->email);
    //                $message->subject('SignUp OTP');
    //            });
            Session::put('email',$student->email);
            return redirect('/student/verify-otp')->with(['email'=>$student->email]);
        }
        return back();
    }

    public function showOtpForm(){
        $send_data['verify_email'] = Session::get('email');
        return view('student.auth.otp-verification',$send_data);
    }
   public function verifyOtp(Request $request){

    $student = Student::where('email',$request->verify_email)->where('otp',$request->otp)->first();
    if(!is_null($student)){
        $student->active_status = 1;
        $student->is_approved = 'no';
        $student->otp = '';
        $student->save();
        $data['amount'] = 23;
        $data['email'] = $request->verify_email;
        
        return redirect('/student/login')->with(['success','Your account has been created']);
    }else{
        return redirect('/student/verify-otp')->with(['email'=>$request->verify_email,'error'=>'Invalid OTP']);
    }   
   }

    public function studenLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);
        if (\Auth::guard('student')->attempt($request->only(['email', 'password']))) {
            $student = Auth::guard('student')->user();

        // Update the last_login_at attribute
        DB::table('students')
            ->where('id', $student->id)
            ->update(['last_login_details' => now()]);
            return redirect('student/dashboard');
        }
        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
            \Auth::guard('student')
                ->logout();
    
            return redirect('student/login')->with('success', 'User Logged out Successfully');
    }
    
    public function checkMail(Request $request){
         $student = Student::where('email',$request->email)->where('active_status',1)->first();
            if(!is_null($student)){
                $check = "true";
            }else{
                $check = "false";
            }
        return $check;
    }
    
    public function CourseList(Request $request){
      $course_ids = Subscription::where("institution_id",$request->institution_id)->where('active_status',1)->pluck('course_id')->toArray();
      $send_data['courses'] = Course::whereIn('id',$course_ids)->where('active_status',1)->get();
      return view('student.auth.get-course',$send_data);
    }
    
     public function CourseYearList(Request $request){
//       $send_data['course_years'] = Subscription::where("institution_name",$request->institution_id)->where("course_name",$request->course_id)->where("active_status",1)->pluck("passing_year")->toArray();
        $course= Course::where("id",$request->course_id)->first();
        $send_data['duration'] = $course->study_duration;
       return view('student.auth.get-course-year',$send_data);  
     }
    
    public function forgetPasswordForm(){
        return view('student.auth.forgetpassword');
    }
    
    public function forgetOtp(Request $request){
        $student = Student::where('phone_number',$request->mobile)->first();
            if(!is_null($student)){
                $randomString = Str::random(20);
                while (Student::where('reset_string', $randomString)->exists()) {
                    $randomString = Str::random(20);
                }
                 $student->otp = str_pad(mt_rand(0, 9999), 4, '0', STR_PAD_LEFT);
                 $student->reset_string = $randomString;
                if($student->save()){
                    send_sms($student->phone_number,$student->otp);
//                    Mail::send('email.reset', ['email' => $student->email,'otp'=>$student->otp], function ($message) use ($student) {
//                        $message->to($student->email);
//                        $message->subject('Reset Password OTP');
//                    });
                    Session::put('email',$student->email);
                    return redirect('/student/forget-password-verify-otp/'.$randomString)->with(['email'=>$student->email]);
                }
            }else{
                return redirect()->back()->with('error','Student Not Found');
        }
    }
    
    public function verifyLoginOtp(Request $request){
        $student = Student::where('email',$request->verify_email)->where('otp',$request->otp)->first();
        if(!is_null($student)){
            $student->otp = '';
            $student->save();
            $data['amount'] = 23;
            $data['email'] = $request->verify_email;

            return redirect('/student/reset-password/'.$student->reset_string)->with(['success','Your account has been created']);
        }else{
            return redirect('/student/verify-otp')->with(['email'=>$request->verify_email,'error'=>'Invalid OTP']);
        }   
   }
    
    public function verifyResetOtpForm($reset_string){
           $student = Student::where('reset_string',$reset_string)->first();
            if(!is_null($student)){
                 $data['student'] = $student;
                 return view('student.auth.reset-otp-password',$data);
            }else{
                return redirect()->back()->with('error','Student Not Found');
            }
    }
    
    public function reserPasswordForm(Request $request){
        $student = Student::where('reset_string',$request->reset_string)->where('otp',$request->otp)->first();
        if(!is_null($student)){
             $data['student'] = $student;
             return view('student.auth.reset-password',$data);
        }else{
            return redirect()->back()->with('error','Student Not Found');
        }
    }
    
    public function updatePassword(Request $request){
           $student = Student::where('email',$request->verify_email)->first();
            if(!is_null($student)){
                 $student->password = Hash::make($request->password);
                 $student->save();
                 return redirect('student/login')->with('success','Password has been updated');
            }else{
                return redirect()->back()->with('error','Student Not Found');
            }
    }
    
       public function checkMobile(Request $request)
    {

        if (isset($request->exist_value)) {
            if ($request->exist_value == $request->mobile) {
                $check = "false";
            } else {
                $student = Student::where('phone_number', $request->mobile)->where('active_status', 1)->first();
                if (!is_null($student)) {
                    $check = "true";
                } else {
                    $check = "false";
                }
            }
        } else {
            $student = Student::where('phone_number', $request->mobile)->where('active_status', 1)->first();
            if (!is_null($student)) {
                $check = "true";
            } else {
                $check = "false";
            }
        }
        return $check;
    }

}

