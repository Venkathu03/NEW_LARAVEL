<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\MacAddressMaster;
use Illuminate\Http\Request;
use App\Traits\ApiResponser;
use Validator;
use Hash;
use Auth;
use Laravel\Passport\RefreshToken;
use Laravel\Passport\Token;
class AuthController extends Controller
{
 use ApiResponser;
   public function login(Request $request)
    {
        try{
            if($request->email!='sifydemo1@gmail.com'){
             $rules = ['email' => 'required','password'=>'required','mac_address'=>'required'];   
            }else{
                $rules = ['email' => 'required','password'=>'required'];     
            }
            $validator = Validator::make($request->all() , $rules);
            if ($validator->fails())
            {
                return response()
                    ->json(array(
                    'errors' => $validator->getMessageBag()
                        ->toArray()
                ),422);
            }

            $attr['email']=$request->email;
            $attr['password']=$request->password;

            if (!Auth::guard('student')->attempt($attr)) {
                return $this->error('Credentials mismatch', 401);
            }
            $user = Auth::guard('student')->user();
            if($user->active_status == 1){
                if($request->email!='sifydemo1@gmail.com'){
                    $mac = MacAddressMaster::where("institution_id",$user->institution_id)->where('mac_address',$request->mac_address)->first();
                    if(is_null($mac)){
                         return response()->json(['status' => false, 'message' => 'Mac Address mismatched'], 200);
                    }
                }
                if($user->is_payment_done == "yes"){
                        $token = $user->createToken('Medism')->accessToken;
                        $user_info = Student::where('id', $user->id)->first();
                        $pagination['user_id']=$user->id;
                        $pagination['api_token']=$token;  
                        return $this->success($pagination, 'User logged in Successfully');  
                }else{
                     return response()->json(['status' => false, 'message' => 'Subscription not completed'], 200);  
                }
            }else{
               return response()->json(['status' => false, 'message' => 'Invalid User'], 200);  
            }
        
           } catch (Exception $e) {
                return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
            }

    }
    
    public function logout(Request $request)
    {
       try {
            $user = Auth::user();
            $token = $user->token();
            $token->revoke();
            $pagination['status']="true"; 
            return $this->success($pagination, 'User logged out successfully !');  
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function profile(Request $request)
    {
       try {
            $user = Auth::user();   
          
            $pagination['user_id']=$user->id;      
            $pagination['name']=$user->fullname;  
            $pagination['email']=$user->email; 
            return $this->success($pagination, 'Profile Detail Found');  
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}