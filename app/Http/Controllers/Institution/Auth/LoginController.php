<?php

namespace App\Http\Controllers\Institution\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\InstitutionMaster;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Mail;
use Session;

class LoginController extends Controller
{
     use AuthenticatesUsers;
    
     protected $redirectTo = RouteServiceProvider::HOME;

     public function __construct()
     {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:institution')->except('logout');
     }

     public function showAdminLoginForm()
     {
        return view('institution.auth.login', ['url' => route('institution.login-view'), 'title'=>'Institution Login']);
     }
    
    public function institutionLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required'
        ]);

        if (\Auth::guard('institution')->attempt($request->only(['email', 'password']))) {
            $institution = Auth::guard('institution')->user();
            DB::table('institution_masters')
            ->where('id', $institution->id)
            ->update(['last_login_details' => now()]);
            return redirect('institution/dashboard');
        }
        return redirect()->back()->with('error', 'Invalid Credentials');
    }
    
}
