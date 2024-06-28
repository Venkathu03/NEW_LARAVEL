<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Arr;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // if ($request->expectsJson()) {
        //     $json = [
        //         'isAuth'=>false,
        //         'message' => $exception->getMessage()
        //     ];
        //     return response()
        //         ->json($json, 401);
        // }else {
        //     return redirect('admin/login');
        // }
        
        // return response()->json(['error' => ['message' => 'Unauthenticated.']], 401);

       

        $guard = Arr::get($exception->guards(), 0);
            if ($guard =="api")
            {
                return response()->json([
                    'status'=>'false',
                    'message' => 'Unauthorized',
                    'data' => null
                ], 401);
            }
        switch ($guard)
        {
            case 'admin':
                $login = 'admin.login-view';
            break;
            case 'student':
                $login = 'student.login';
            break;

            default:
            $login = 'admin.login-view';
            break;
        }
        return redirect()->guest(route($login));


    }
}
