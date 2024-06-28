<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProcedureType;

class ProcedureTypeController extends Controller
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
        if(isset($request->id)){
            $procedure = ProcedureType::where('id',$request->id)->first();
            $procedure->active_status=$request->active_status;
        }else{
            $procedure = ProcedureType::where('procedure_type_name',$request->procedure_type_name)->count();
       
            if($procedure == 0){    
                $procedure = new ProcedureType;
                $procedure->active_status=1;
            }else{
                // return redirect()->back();
                return redirect()->back()->with(['error'=>'Procedure Type Name Already Exist','master-procedure-type'=>'procedure-type']);
            }
        }
        $procedure->procedure_type_name =  $request->procedure_type_name;
        
        $procedure->save();
        // return redirect()->back();
        return redirect()->back()->with(['success'=>'Procedure Type saved successfully.','master-procedure-type'=>'procedure-type']);

        
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
        $type= ProcedureType::find($id);
        $type->active_status=3;
        $type->save();        
        return redirect()->back()->with(['success'=>'Record deleted successfully.','master-procedure-type'=>'procedure-type']);
    }

}
