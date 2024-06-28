<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MacAddressMaster;
use App\Models\InstitutionMaster;

class MacAddressController extends Controller
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
            $mac_address = MacAddressMaster::where('id',$request->id)->first();
              $mac_address->active_status=$request->active_status;
        }else{
            $mac_address = MacAddressMaster::where('mac_address',$request->mac_address)->count();
            if($mac_address == 0){    
                $mac_address = new MacAddressMaster;
            }else{
                // return redirect()->back();
                return redirect()->back()->with(['error'=>'MAC Address Already Exist.','mac-address'=>'mac-address']);
            }
            
        }
       
        $mac_address->mac_address =  $request->mac_address;
        $mac_address->institution_id =  $request->institution_id;
        $mac_address->save();
        return redirect()->back()->with(['success'=>'MAC Address record saved successfully.','mac-address'=>'mac-address']);
        
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
        $mac_address = MacAddressMaster::find($id);
        $mac_address->active_status=3;
        $mac_address->save();        
         return redirect()->back()->with(['success'=>'MAC Address deleted successfully.','mac-address'=>'mac-address']);
    }

    public function ViewForm(Request $request){


        // $institution = InstitutionMaster::where('id',$student->institution_id)->first();
        
        // $send_data['institution'] = $institution;


        if( $request->form_type =="mac-address"){
            if(isset($request->id)){       
                $send_data['mac_address'] = MacAddressMaster::where('id',$request->id)->first();
            }
            else{$send_data['mac_address'] = null;} 
            $view = "add_mac_address";
        }
        $send_data['institutions'] = InstitutionMaster::where('is_registered','yes')->where('active_status', '!=', 3)->get();
        $send_data['un_registered'] = InstitutionMaster::where('is_registered', 'no')->where('active_status', '!=', 3)->get();
        return view('admin.master.'.$view,$send_data);
    }
}
