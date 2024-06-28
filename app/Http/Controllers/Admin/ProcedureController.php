<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Procedure;
use App\Models\ProcedureType;
use App\Models\ProcedureTypeMapping;

class ProcedureController extends Controller
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
            $procedure = Procedure::where('id',$request->id)->first();
            $procedure->active_status =  $request->active_status;
            }else{
                $procedure = Procedure::where('procedure_name',$request->procedure_name)->count();
                if($procedure == 0){    
                     $procedure = new Procedure;
                }else{
                    return redirect()->back()->with(['error'=>'Procedure Name Already Exist','master-procedure'=>'master-procedure']);
                }
            }
            $procedure_type_ids = $request->procedure_type_ids;
            if (!is_array($procedure_type_ids))
            {
                $procedure_type_ids = [];  
            }
            foreach($procedure_type_ids as $st){
                $procedure_types[]=$st;
            }
            $procedure->procedure_type_id = isset($procedure_types) ? implode(",",$procedure_types):"";
            $procedure->procedure_name =  $request->procedure_name;
            $procedure->institution= $request->institution_id;
            $procedure->batch_year= $request->batch_year;
            $procedure->description =  $request->description;
        if ($request->hasFile('image')) {
                $image = $request->file('image');
                if ($image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'jpg') {
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/procedure'), $imageName);
                    $procedure->procedure_image = $imageName;
                    
                } else {
                    return redirect()->back()->with(['error'=>'Please upload only image as jpg or png.','master-procedure'=>'master-procedure']);
                }
            }
           $procedure->save();
         return redirect()->back()->with(['success'=>'Procedure saved successfully.','master-procedure'=>'procedure']);
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
        $type= Procedure::find($id);
        $type->active_status=3;
        $type->save();        
        return redirect()->back()->with(['success'=>'Record deleted successfully.','master-procedure'=>'procedure']);
    }

    public function ViewForm(Request $request){
        if( $request->form_type =="procedure"){
            if(isset($request->id)){
                $send_data['procedure'] = Procedure::where('id',$request->id)->first();
            }
            $send_data['procedure_types'] = ProcedureType::where('active_status',1)->get();
            $view = "add_procedure";
        }elseif($request->form_type =="procedure-type"){
            $view = "add_procedure_type";
            $send_data['procedure_type'] = ProcedureType::where('id',$request->id)->first();
        }
        return view('admin.master.'.$view,$send_data);
    }
}
