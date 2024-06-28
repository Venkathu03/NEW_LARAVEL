<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InstitutionMaster;
use Illuminate\Support\Facades\Hash;
use App\Models\Student;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $send_data['registered'] = InstitutionMaster::where('is_registered', 'Yes')->where('active_status', '!=', 3)->get();
        $send_data['un_registered'] = InstitutionMaster::where('is_registered', 'No')->where('active_status', '!=', 3)->get();
        return view('admin.master.institution.index', $send_data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $send_data['registered'] = InstitutionMaster::where('is_registered', 'No')->get();
        return view('admin.master.institution.edit', $send_data);
    }


    public function CreateInstitution(Request $request)
    {

        $send_data['is_registered'] = $request->is_registered;
        return view('admin.master.institution.add', $send_data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $institution = new InstitutionMaster;
        $institution->institution_name = $request->institution_name;
        $institution->contact_name = $request->contact_name;
        $institution->phone_number = $request->phone_number;
        $institution->designation = $request->designation;
        $institution->email = $request->email;
        $institution->password = Hash::make($request->password);
        $institution->active_status = 1;
        $institution->is_registered = $request->is_registered;
        $institution->save();
        return redirect()->back()->with(['success'=>'Institution saved successfully.','mac-address'=>'mac-address']);
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
        $send_data['institution'] = InstitutionMaster::find($id);
        return view('admin.master.institution.edit', $send_data);
    }


    public function InstituteEdit(Request $request)
    {
        $send_data['institution'] = InstitutionMaster::find($request->id);
        return view('admin.master.institution.edit', $send_data);
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
        $institution = InstitutionMaster::find($id);
        $institution->institution_name = $request->institution_name;
        $institution->contact_name = $request->contact_name;
        $institution->phone_number = $request->phone_number;
        $institution->designation = $request->designation;
        $institution->email = $request->email;
        $institution->active_status = $request->active_status;

        if (isset($request->password)) {
            $institution->password = Hash::make($request->password);
        }
        $institution->is_registered = $request->is_registered;
        $institution->save();
        return redirect()->back()->with(['success'=>'Institution has been updated successfully.','mac-address'=>'mac-address']);
    }

    public function checkInstitutionMail(Request $request)
    {
        if (isset($request->exist_value)) {
            if ($request->exist_value == $request->email) {
                $check = "false";
            } else {
                $institution = InstitutionMaster::where('email', $request->email)->first();
                if (!is_null($institution)) {
                    $check = "true";
                } else {
                    $check = "false";
                }
            }
        } else {
            $institution = InstitutionMaster::where('email', $request->email)->first();
            if (!is_null($institution)) {
                $check = "true";
            } else {
                $check = "false";
            }
        }
        return $check;
    }



    public function checkInstitutionMobile(Request $request)
    {

        if (isset($request->exist_value)) {
            if ($request->exist_value == $request->mobile) {
                $check = "false";
            } else {
                $institution = InstitutionMaster::where('phone_number', $request->mobile)->first();
                if (!is_null($institution)) {
                    $check = "true";
                } else {
                    $check = "false";
                }
            }
        } else {
            $institution = InstitutionMaster::where('phone_number', $request->mobile)->first();
            if (!is_null($institution)) {
                $check = "true";
            } else {
                $check = "false";
            }
        }
        return $check;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $type = InstitutionMaster::find($id);
        $type->active_status = 3;
        $type->save();
        return redirect()->back()->with(['success' => 'Record deleted successfully.']);
    }

    public function checkInstitution(Request $request)
    {
        if (isset($request->institution_name)) {
            $institution = InstitutionMaster::where('institution_name', $request->institution_name)->first();
            $data['error_msg'] = "Institution Name already Exist !";
        } elseif ($request->email) {
            $institution = InstitutionMaster::where('email', $request->email)->first();
            $data['error_msg'] = "Email already Exist !";
        } else {
            $institution = InstitutionMaster::where('phone_number', $request->mobile)->first();
            $data['error_msg'] = "Mobile Number already Exist !";
        }

        if (!is_null($institution)) {
            $data['status'] = "true";
        } else {
            $data['status'] = "false";
        }
        $data['type'] = $request->type;
        return $data;
    }
    
    public function view($id) {
        $send_data['institution'] = InstitutionMaster::find($id);
        $send_data['students'] = Student::where('institution_id',$id)->where('active_status','!=',3)->get();
        return view('admin.master.institution.view', $send_data);
    }
}
