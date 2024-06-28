<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LabMaster;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //ProcedureType
        
        if(isset($request->id)){
            $lab = LabMaster::where('id',$request->id)->first();
            $lab->active_status=$request->active_status;
        }else{
            $lab = LabMaster::where('lab_name',$request->lab_name)->count();
            if($lab == 0){    
                $lab = new LabMaster;
                $lab->active_status = 1;
            }else{
                return redirect()->back()->withErrors('Lab Name Already Exist.');
            }
            
        }
        $lab->lab_name =  $request->lab_name;
       
        $lab->save();
         return redirect()->back()->with(['success'=>'Lab detail saved successfully.','lab-master'=>'lab-master']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lab= LabMaster::find($id);
        $lab->active_status=3;
        $lab->save();        
        return redirect()->back()->with(['success'=>'Record deleted successfully.','lab-master'=>'lab-master']);
    }

    public function ViewForm(Request $request){

        if( $request->form_type =="lab"){
            if(isset($request->id)){       
                $send_data['lab'] = LabMaster::where('id',$request->id)->first();
            }
            else{$send_data['lab'] = null;} 
            $view = "add_lab";
        }
        return view('admin.master.'.$view,$send_data);
    }
}
