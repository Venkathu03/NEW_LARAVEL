<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $send_data['courses'] = Course::where('active_status','!=',3)->get();
        return view('admin.master.course.index',$send_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = Course::where("course_name",$request->course_name)->where('active_status', 1)->first();
        if(!is_null($course)){
             return redirect()->back()->withErrors('Course Name Already Exist.');
        }
        $course = new Course;
        $course->course_name = $request->course_name;
        $course->study_duration = $request->study_duration;
        $course->save();
        return redirect()->back()->with(['success'=>'Course name added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $send_data['course'] = Course::find($id);
        return view('admin.master.course.edit',$send_data);
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
        $course = Course::find($id);
        $course->course_name = $request->course_name;
        $course->active_status = $request->active_status;
        $course->study_duration = $request->study_duration;
        $course->save();
        return redirect()->back()->with(['success'=>'Course name updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
    {
        $type= Course::find($id);
        $type->active_status=3;
        $type->save();        
        return redirect()->back()->with(['success'=>'Record deleted successfully.']);
    }
}
