<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        if(!Auth::guard('student')->user() && Auth::guard('student')->user()->is_payment_done =="yes"){
            return redirect('/student/login');
        }elseif(Auth::guard('student')->user()->is_approved =="no"){
            return redirect('/student/pending-approval');
        }
        else{
            return $next($request);
        }
        // if(Auth::guard('student')->check() && Auth::guard('student')->user()->is_approved =="no"){
        //     return redirect('student/pending-approval');
        // }else{
        //     return $next($request);
        // }
        
    }
}
