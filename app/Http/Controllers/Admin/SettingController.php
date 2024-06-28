<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Setting;
use Hash;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function Profile(){
        return view('admin.setting.profile');
    }
    
    public function UpdateProfile(Request $request){
         
          $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust rules as needed.
          ]);

            if ($validator->fails()) {
                 return redirect()->back()->with(['error-profile'=>'File Should be jpg,png','profile-sec'=>'profile-sec']);
            }
        
        $admin = auth('admin')->user();
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->mobile = $request->mobile;
        if ($request->hasFile('image')) {
                $image = $request->file('image');
            
                // Check if the uploaded file is an image (PNG or JPEG)
                if ($image->getClientOriginalExtension() == 'png' || $image->getClientOriginalExtension() == 'jpeg' || $image->getClientOriginalExtension() == 'jpg') {
                    $imageName = time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('/setting'), $imageName);
                    $admin->image = $imageName;
                } else {
                    return redirect()->back()->with(['error'=>'Please upload only image as jpg or png.','master-procedure'=>'master-procedure']);
                }
            }
        
        $admin->save();
        return redirect()->back()->with('profile-success','Profile detail updated');
    }
    
    
    public function UpdatePassword(Request $request){
        $admin = auth('admin')->user();
        $admin->password = Hash::make($request->password);
        $admin->save();
        return redirect()->back()->with('update-password','Password has been updated');
    }
    
    public function TermsSetting(){
         $data['setting'] = Setting::where('key','terms-and-condition')->first();
         return view('admin.setting.terms-condition',$data);
    }
    
     public function PrivacySetting(){
         $data['setting'] = Setting::where('key','privacy-policy')->first();
         return view('admin.setting.privacy',$data);
    }
    
    public function UpdateSetting(Request $request){
        $setting = Setting::where('key',$request->setting_key)->first();
        if(!is_null($setting)){
            $setting->value = $request->value;
            $setting->save();
        }else{
            $setting = new Setting;
            $setting->value = $request->value;
            $setting->key = $request->setting_key;
            $setting->save();
        }
        return redirect()->back()->with('success','Settings Updated');
    }
}
