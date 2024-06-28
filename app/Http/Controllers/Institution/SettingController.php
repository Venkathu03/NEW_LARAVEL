<?php

namespace App\Http\Controllers\Institution;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function Profile(){
        if(!auth('institution')->user()){
            return redirect('/institution/login');
        }
        $send_data['institution'] = auth('institution')->user();
        return view('institution.setting.profile',$send_data);
    }
    
    public function UpdatePassword(Request $request){
         if(!auth('institution')->user()){
            return redirect('/institution/login');
        }
        $institution = auth('institution')->user();
        if (Hash::check($request->current_password, auth('institution')->user()->password)) {
          
            $institution->password = Hash::make($request->password);
            $institution->save();
            return redirect()->back()->with(['update-password'=>'Password has been updated','password-sec'=>'password-sec']);
         }else{
             return redirect()->back()->with(['error-password'=>'Curret Password does not matched','password-sec'=>'password-sec']);
        }
       
    }
    
    
    
        public function UpdateProfile(Request $request){
           
            $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust rules as needed.
          ]);

            if ($validator->fails()) {
                 return redirect()->back()->with(['error-profile'=>'File Should be jpg,png','profile-sec'=>'profile-sec']);
            }
     
         $institution = auth('institution')->user();
         if(isset($request->image)){
                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('/setting'), $imageName);
                $institution->image = $imageName;
                $institution->save();
              return redirect()->back()->with(['update-profile'=>'Profile Image has been updated','profile-sec'=>'profile-sec']);
        }else{
              return redirect()->back()->with(['error-profile'=>'Profile Image not updated','profile-sec'=>'profile-sec']);
             
         }
     }
}
