<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;

Route::get('/', function () {
    if(auth('student')->user()){
         return redirect('/student/dashboard');
    }else{
         return redirect('/student/login');
    }
    
});

Auth::routes();

Route::get('/student','App\Http\Controllers\Student\Auth\LoginController@showAdminLoginForm')->name('student.login-view');
Route::get('/student/login','App\Http\Controllers\Student\Auth\LoginController@showAdminLoginForm');
Route::post('/student','App\Http\Controllers\Student\Auth\LoginController@studenLogin')->name('student.login');
Route::get('/student/signup','App\Http\Controllers\Student\Auth\LoginController@showStudentSignUpForm');
Route::post('/student/signup-store','App\Http\Controllers\Student\Auth\LoginController@StoreStudent')->name('student.register');
Route::get('/student/verify-otp','App\Http\Controllers\Student\Auth\LoginController@showOtpForm');
Route::post('/student/post-verify-otp','App\Http\Controllers\Student\Auth\LoginController@verifyOtp')->name('student.verify.otp');
Route::get('/student/pending-approval','App\Http\Controllers\Student\Auth\DashboardController@PendingApproval');
Route::post('/student/paymentdetail','App\Http\Controllers\Student\Auth\DashboardController@paymentdetail')->name('student.get.payment');

Route::post('/student/check-mail','App\Http\Controllers\Student\Auth\LoginController@checkMail')->name('student.check.email');
Route::post('/student/course-list','App\Http\Controllers\Student\Auth\LoginController@CourseList')->name('student.get.course-list');

Route::post('/student/course-years-list','App\Http\Controllers\Student\Auth\LoginController@CourseYearList')->name('student.get.course-years-list');

Route::get('/student/payment-success','App\Http\Controllers\Student\Auth\DashboardController@PaymentSuccess');

Route::get('/student/forget-password','App\Http\Controllers\Student\Auth\LoginController@forgetPasswordForm');

Route::post('/student/send-forget-otp','App\Http\Controllers\Student\Auth\LoginController@forgetOtp')->name('student.forget.otp');

Route::get('/student/reset-password/{reset_token}','App\Http\Controllers\Student\Auth\LoginController@reserPasswordForm');

//forget-password-verify-otp
Route::get('/student/forget-password-verify-otp/{token}','App\Http\Controllers\Student\Auth\LoginController@verifyResetOtpForm');

Route::post('/student/send-reset-otp','App\Http\Controllers\Student\Auth\LoginController@reserPasswordForm')->name('student.verify.reset.otp');


Route::post('/student/store-reset-password','App\Http\Controllers\Student\Auth\LoginController@updatePassword')->name('store.student.password');

Route::post('/student/check-mobile','App\Http\Controllers\Student\Auth\LoginController@checkMobile')->name('student.check.mobile');

//,'middleware' => ['studentAccess']
Route::group(['prefix' => 'student','middleware' => ['auth:student']], function () {
    Route::get('/dashboard','App\Http\Controllers\Student\Auth\DashboardController@Index')->name('student.dashboard');
    //logout
    Route::post('/logout','App\Http\Controllers\Student\Auth\LoginController@logout')->name('student.logout.submit');
    Route::get('/logout','App\Http\Controllers\Student\Auth\LoginController@logout');
   // Route::post('/paymentdetail','App\Http\Controllers\Student\Auth\DashboardController@paymentdetail')->name('student.get.payment');

   Route::get('/report','App\Http\Controllers\Student\ReportController@index');
    
     Route::get('/settings','App\Http\Controllers\Student\SettingController@Profile');

    Route::post('/update-password','App\Http\Controllers\Student\SettingController@UpdatePassword')->name('student.change.password');
    
    Route::post('/update-profile','App\Http\Controllers\Student\SettingController@UpdateProfile')->name('student.change.profile');
    
    Route::post('/filter-by-type','App\Http\Controllers\Student\Auth\DashboardController@FilterByType');
    
    Route::get('/procedures','App\Http\Controllers\Student\ProcedureController@Index');
    Route::get('/procedure/view/{id}','App\Http\Controllers\Student\ProcedureController@ViewProcedure');
    
   Route::get('/about','App\Http\Controllers\Student\AboutController@index');
   Route::get('/learning-material','App\Http\Controllers\Student\VideosController@index');

    
    
});

