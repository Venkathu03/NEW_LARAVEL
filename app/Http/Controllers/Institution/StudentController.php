<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\InstitutionMaster;
use App\Models\Subscription;
use App\Models\Course;
use App\Models\SubscriptionFee;
use Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth('institution')->user()){
            return redirect('/institution/login');
         }
        
        $id = auth('institution')->user()->id;
        $send_data['students'] = Student::where("institution_id",$id)->get();
        $send_data['courses'] = Course::where('active_status',1)->get();
        return view('institution.master.student.index',$send_data);
    }


    public function getInstitutionType(Request $request){
        $this->data['institution_type'] = InstitutionMaster::where('is_registered',$request->ins_type)->get();
        return response()->json($this->data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $send_data['courses'] = Course::where('active_status',1)->get();
        return view('institution.master.student.create',$send_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = auth('institution')->user()->id;
        $institution = InstitutionMaster::find($id);

        $student = new Student;
        $student->fullname = $request->fullname;
        $student->password = Hash::make($request->password);
        $student->email = $request->email;
        $student->phone_number = $request->phone_number;
        $student->email = $request->email;
        $student->institution_id = $id;
        $student->institution_name = $institution->institution_name;
        $student->is_approved ="yes";
        $student->study_year =$request->year_level;
        $student->year_level =$request->year_level;
        $student->enrollment_year = date('Y');
        $student->course_name = $request->course_name;
        $student->passing_year = $request->passing_year;
        $student->active_status = 1;
        $student->save();
        return redirect()->back()->with('success','Student added succesfully');
    }


    public function EditStudent(Request $request){
        $student = Student::find($request->id);
        // $send_data['student'] = Student::find($request->id);
        $institution = InstitutionMaster::where('id',$student->institution_id)->first();
        $send_data['institution_type'] = InstitutionMaster::where('is_registered',$institution->is_registered)->get();
        $send_data['institution'] = $institution;
        $send_data['student'] = $student;
        $send_data['courses'] = Course::where('active_status',1)->get();
        return view('institution.master.student.edit',$send_data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $student = Student::find($id);
        $student->fullname = $request->fullname;
        if(isset($request->password)){
           $student->password = Hash::make($request->password); 
        }        
        $student->email = $request->email;
        $student->phone_number = $request->phone_number;
        $student->email = $request->email;
        $student->is_approved ="no";
         $student->study_year =$request->year_level;
        $student->year_level =$request->year_level;
        $student->enrollment_year = date('Y');
        $student->course_name = $request->course_name_one;
        $student->active_status = $request->active_status;
        $student->passing_year = $request->passing_year;
        $student->save();
       return redirect()->back()->with(['success'=>'Student updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function CourseList(Request $request){
      $course_ids = Subscription::where("institution_name",auth('institution')->user()->id)->pluck('course_name')->toArray();
      $send_data['courses'] = Course::whereIn('id',$course_ids)->get();
    
      return view('institution.master.student.get-course',$send_data);
    }
    
     public function CourseYearList(Request $request){
       $send_data['course_years'] = Subscription::where("institution_name",auth('institution')->user()->id)->where("course_name",$request->course_id)->where("active_status",1)->pluck("passing_year")->toArray();
       return view('institution.master.student.get-course-year',$send_data);  
     }
    
     public function paymentdetail(Request $request){
       
        $subscription = Subscription::where('course_name',$request->course_id)->where('passing_year',$request->pass_year)->first();
          //dd($subscription);
        if(!is_null($subscription)){
            $course =  Course::find($request->course_id);
            $currentDate = date('Y-m-d');
            $yearVariable = $request->pass_year;
            $yearTimestamp = strtotime($yearVariable . '-08-01');
            $diffYears = date('Y', $yearTimestamp) - date('Y', strtotime($currentDate));
            if (date('m', strtotime($currentDate)) < 8) {
                $diffYears -= 1;
            }
            $sub_fee = SubscriptionFee::where('subscription_id',$subscription->id)->where('year',$diffYears)->first();
            return !is_null($sub_fee) ? $sub_fee:0;
            
        }else{
             return "false";
        }
  
    }
    
      public function checkMail(Request $request){
          if(isset($request->exist_value)){
              if($request->exist_value == $request->email){
                 $check = "false";
                }
              else{
                    $student = Student::where('email',$request->email)->first();
                    if(!is_null($student)){
                        $check = "true";
                    }else{
                        $check = "false";
                    }
                }
              
          }else{
                $student = Student::where('email',$request->email)->first();
                if(!is_null($student)){
                    $check = "true";
                }else{
                    $check = "false";
                }
          }
        return $check;
    }
     public function checkMobile(Request $request){
         
         if(isset($request->exist_value)){
              if($request->exist_value == $request->mobile){
                 $check = "false";
                }
              else{
                      $student = Student::where('phone_number',$request->mobile)->first();
                    if(!is_null($student)){
                        $check = "true";
                    }else{
                        $check = "false";
                    }
                }
              
          }else{
               $student = Student::where('phone_number',$request->mobile)->first();
                if(!is_null($student)){
                    $check = "true";
                }else{
                    $check = "false";
                }
          }
        return $check;
         
    }
}
