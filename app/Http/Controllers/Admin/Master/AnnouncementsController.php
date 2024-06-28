<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcements;

use App\Models\InstitutionMaster;
use DB;

class AnnouncementsController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $send_data['institutions'] = InstitutionMaster::where('active_status',1)->get();
        $send_data['announcements'] = announcements::join('institution_masters', 'announcements.institution_id', '=', 'institution_masters.id')
    ->select('announcements.*', 'institution_masters.institution_name')->where('announcements.active_status','!=',3)
    ->get();

        return view('admin.master.announcements.index',$send_data);
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
        $announcements = new Announcements;
        $announcements->institution_id = $request->institution_name;
        $announcements->title = $request->title;
        $announcements->discription = $request->discription;
        $announcements->active_status=1;
        $announcements->save();
        return redirect()->back()->with('success', 'Record Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $send_data['institutions'] = InstitutionMaster::where('active_status',1)->get();
        $announcements = announcements::findOrFail($id);

        $announcementWithInstitution = announcements::join('institution_masters', 'announcements.institution_id', '=', 'institution_masters.id')
    ->where('announcements.id', $id)
    ->select('announcements.*', 'institution_masters.institution_name')
    ->first();
    $send_data['announcements'] = $announcementWithInstitution;
        return view('admin.master.announcements.edit',$send_data);
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
        $announcements = Announcements::find($id);
        $announcements->institution_id = $request->institution_name;
        $announcements->title = $request->title;
        $announcements->discription = $request->discription;
        $announcements->active_status = $request->active_status;
        $announcements->save();
      
        return redirect()->back()->with('success', 'Record Update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    
    {
       $announcements = announcements::find($id);

        if ($announcements) {
            // $announcement->delete();
            $announcements->active_status = 3;
            $announcements->save();
            return redirect()->back()->with('success', 'Record Deleted successfully.');
        } else {
             return redirect()->back()->with('error', 'Record not Deleted.');
        }
    }
    
    
}
