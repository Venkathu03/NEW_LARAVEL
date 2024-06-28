<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $guard='admin';
        if (Auth::guard($guard)->check()) {
            switch ($guard) {
                case 'admin':
                    $login = 'admin/dashboard';
                    break;
                default:
                    $login = 'admin/login';
                    break;
            }
            return redirect($login);
            }   elseif(Auth::guard('student')->check()){
                switch ($guard) {
                    case 'student':
                        $login = 'student/dashboard';
                        break;
                    default:
                        $login = 'student/login';
                        break;
                }
                return redirect($login);
            }
        return $next($request);
    }
}