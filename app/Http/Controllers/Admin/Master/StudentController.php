<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\InstitutionMaster;
use App\Models\Course;
use App\Models\Subscription;
use App\Models\SubscriptionFee;
use Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->institution_id) {

            $send_data['unregistered_students'] = Student::where('institution_id', '=', $request->institution_id)->where('is_registered', '=', 'no')->where('active_status', '!=', 3)->get();
            $send_data['students'] = Student::where('institution_id', '=', $request->institution_id)->where('is_registered', '=', 'yes')->where('active_status', '!=', 3)->get();
        } else {
            $send_data['unregistered_students'] = Student::where('is_registered', '=', 'no')->where('active_status', '!=', 3)->get();
            $send_data['students'] = Student::where('is_registered', '=', 'yes')->where('active_status', '!=', 3)->get();
        }


        $send_data['institution_registered'] = InstitutionMaster::where('is_registered', 'Yes')->where('active_status',1)->get();
        $send_data['institution_unregistered'] = InstitutionMaster::where('is_registered', 'No')->where('active_status',1)->get();

        $send_data['courses'] = Course::where('active_status', 1)->get();
        return view('admin.master.student.index', $send_data);
    }

    public function getregisteredinstitution(Request $request){
    $this->data['data'] = [];

        if ($request->institution_id) {
            $value_data = Student::where('institution_id', '=', $request->institution_id)->where('is_registered', '=', 'yes')->where('active_status', '!=', 3)->get();
        }else{
            $value_data =  Student::where('is_registered', '=', 'yes')->where('active_status', '!=', 3)->get();
        }

        foreach ($value_data as $key => $value) {
            $one_data['id'] = $value->id;
            $option = (string)View('admin.master.student.edit_delete_option',$one_data);

            $one_array = array(
                'id' => $key + 1,
                'fullname' => $value->fullname,
                'institution_name' => $value->institution->institution_name,
                'is_registered' => ($value->institution->is_registered =="yes") ? "Registered":"UnRegistered",
                'course' => $value->course->course_name,
                'study_year' => $value->study_year,
                'enrollment_year' => $value->enrollment_year,
                'phone_number' => $value->phone_number,
                'email' => $value->email,
                'is_payment_done' => $value->is_payment_done,
                'active_status' => $value->active_status,
                'action' => $option,
            );

            array_push($this->data['data'],$one_array);
            # code...
        }
    
        return response()->json($this->data);
    }

    public function getunregisteredinstitution(Request $request){
        $this->data['data'] = [];

        if ($request->institution_id) {
            $value_data = Student::where('institution_id', '=', $request->institution_id)->where('is_registered', '=', 'no')->where('active_status', '!=', 3)->get();
        }else{
            $value_data =  Student::where('is_registered', '=', 'no')->where('active_status', '!=', 3)->get();
        }


    
            foreach ($value_data as $key => $value) {

                $one_data['id'] = $value->id;
                $option = (string)View('admin.master.student.edit_delete_option',$one_data);
    
                $one_array = array(
                    'id' => $key + 1,
                    'fullname' => $value->fullname,
                    'institution_name' => $value->institution->institution_name,
                    'is_registered' => ($value->institution->is_registered =="yes") ? "Registered":"UnRegistered",
                    'course' => $value->course->course_name,
                    'study_year' => $value->study_year,
                    'enrollment_year' => $value->enrollment_year,
                    'phone_number' => $value->phone_number,
                    'email' => $value->email,
                    'is_payment_done' => $value->is_payment_done,
                    'active_status' => $value->active_status,
                    'action' => $option
                );
    
                array_push($this->data['data'],$one_array);
                # code...
            }
        
            return response()->json($this->data);
        }

    public function getInstitutionType(Request $request)
    {
        $this->data['institution_type'] = InstitutionMaster::where('is_registered', $request->ins_type)->where('active_status', 1)->get();
        return response()->json($this->data);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $send_data['register_type'] = $request->register_type;
        $send_data['courses'] = Course::where('active_status', 1)->get();
        return view('admin.master.student.create', $send_data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $institution = InstitutionMaster::find($request->institution_id);

        $subscription = Subscription::where('institution_id', $request->institution_id)->where('course_id', $request->course_id)->first();

        if (is_null($subscription)) {
            return redirect()->back()->with(['error' => 'No Subscription Found.']);
        }
        $student = Student::where('email', $request->email)->orwhere('phone_number', $request->phone_number)->first();
        if (!is_null($student)) {
            return redirect()->back()->with(['error' => 'Email or Mobile number already exist.']);
        }

        $student = new Student;
        $student->fullname = $request->fullname;
        $student->email = $request->email;
        $student->phone_number = $request->phone_number;
        $student->email = $request->email;
        $student->institution_id = $request->institution_id;
        $student->is_registered = $request->is_register;
        $student->is_payment_done = $request->is_payment_done;
        $student->study_year = $request->study_year;
        $student->year_level = $request->study_year;
        $student->enrollment_year = date('Y');
        $student->course_id = $request->course_id;
        $student->password = Hash::make($request->password);
        $student->active_status = 1;
        $student->batch_year = $request->batch_year;
        $student->subscription_id = $subscription->id;
        $student->save();
        if ($student) {
            $student->course_start_date =  $subscription->course_start_at;
            $student->course_end_date  = $subscription->course_end_at;
            $student->save();
        }
        return redirect()->back()->with('success', 'Student added succesfully');
    }


    public function EditStudent(Request $request)
    {
        $student = Student::find($request->id);
        $institution = InstitutionMaster::where('id', $student->institution_id)->where('active_status', 1)->first();
        $send_data['institution_type'] = InstitutionMaster::where('is_registered', $institution->is_registered)->where('active_status', 1)->get();
        $send_data['institution'] = $institution;
        $send_data['student'] = $student;
        $course_ids = Subscription::where("institution_id", $student->institution_id)->pluck('course_id')->toArray();
        $send_data['courses'] = Course::whereIn('id', $course_ids)->where('active_status', 1)->get();
        $course = Course::where("id", $student->course_id)->first();
        $send_data['duration'] = $course->study_duration;
        return view('admin.master.student.edit', $send_data);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
        $student = Student::find($id);
        $institution = InstitutionMaster::where('id', $student->institution_id)->where('active_status', 1)->first();
        $send_data['institution_type'] = InstitutionMaster::where('is_registered', $institution->is_registered)->where('active_status', 1)->get();
        $send_data['institution'] = $institution;
        $send_data['student'] = $student;
        $send_data['courses'] = Course::where('active_status', 1)->get();
        return view('admin.master.student.edit', $send_data);
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
        $subscription = Subscription::where('institution_id', $request->institution_id)->where('course_id', $request->course_id)->first();

        if (is_null($subscription)) {
            return redirect()->back()->with(['error' => 'No Subscription Found.']);
        }

        $student = Student::find($id);
        $student->fullname = $request->fullname;
        $student->email = $request->email;
        $student->phone_number = $request->phone_number;
        $student->email = $request->email;
        $student->institution_id = $request->institution_id;
        $student->is_registered = $request->institution_type;
        $student->is_payment_done = $request->is_payment_done;
        $student->course_id = $request->course_id;
        $student->batch_year = $request->batch_year;
        $student->study_year = $request->study_year;
        $student->active_status = $request->active_status;
        $student->subscription_id = $subscription->id;
        if (isset($request->password)) {
            $student->password = Hash::make($request->password);
        }
        $student->save();
        if ($student) {
            $student->course_start_date =  $subscription->course_start_at;
            $student->course_end_date  = $subscription->course_end_at;
            $student->save();
        }
        return redirect()->back()->with(['success' => 'Student updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = Student::find($id);
        $type->active_status = 3;
        $type->save();
        return redirect()->back()->with(['success' => 'Record deleted successfully.']);
    }

    public function CourseList(Request $request)
    {
        $course_ids = Subscription::where("institution_id", $request->institution_id)->where('active_status', 1)->pluck('course_id')->toArray();
        $send_data['courses'] = Course::whereIn('id', $course_ids)->where('active_status', 1)->get();

        return view('admin.master.student.get-course', $send_data);
    }

    public function CourseYearList(Request $request)
    {
        // $send_data['course_years'] = Subscription::where("institution_name",$request->institution_id)->where("course_name",$request->course_id)->where("active_status",1)->pluck("passing_year")->toArray();

        $course = Course::where("id", $request->course_id)->first();
        $send_data['duration'] = $course->study_duration;
        return view('admin.master.student.get-course-year', $send_data);
    }

    public function paymentdetail(Request $request)
    {

        $subscription = Subscription::where('course_id', $request->course_id)->where('passing_year', $request->pass_year)->first();
        //dd($subscription);
        if (!is_null($subscription)) {
            $course =  Course::find($request->course_id);
            $currentDate = date('Y-m-d');
            $yearVariable = $request->pass_year;
            $yearTimestamp = strtotime($yearVariable . '-08-01');
            $diffYears = date('Y', $yearTimestamp) - date('Y', strtotime($currentDate));
            if (date('m', strtotime($currentDate)) < 8) {
                $diffYears -= 1;
            }
            $sub_fee = SubscriptionFee::where('subscription_id', $subscription->id)->where('year', $diffYears)->first();
            return !is_null($sub_fee) ? $sub_fee : 0;
        } else {
            return "false";
        }
    }

    public function checkMail(Request $request)
    {
        if (isset($request->exist_value)) {
            if ($request->exist_value == $request->email) {
                $check = "false";
            } else {
                $student = Student::where('email', $request->email)->first();
                if (!is_null($student)) {
                    $check = "true";
                } else {
                    $check = "false";
                }
            }
        } else {
            $student = Student::where('email', $request->email)->first();
            if (!is_null($student)) {
                $check = "true";
            } else {
                $check = "false";
            }
        }
        return $check;
    }
    public function checkMobile(Request $request)
    {

        if (isset($request->exist_value)) {
            if ($request->exist_value == $request->mobile) {
                $check = "false";
            } else {
                $student = Student::where('phone_number', $request->mobile)->first();
                if (!is_null($student)) {
                    $check = "true";
                } else {
                    $check = "false";
                }
            }
        } else {
            $student = Student::where('phone_number', $request->mobile)->first();
            if (!is_null($student)) {
                $check = "true";
            } else {
                $check = "false";
            }
        }
        return $check;
    }
}
