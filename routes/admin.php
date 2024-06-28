<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Master\InstitutionController;
use App\Http\Controllers\Admin\Master\StudentController;
use App\Http\Controllers\Admin\Master\CourseController;
use App\Http\Controllers\Admin\Master\SubscriptionController;
use App\Http\Controllers\Admin\RazorpayController;
use App\Http\Controllers\Admin\Master\AnnouncementsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin','App\Http\Controllers\Admin\Auth\LoginController@showAdminLoginForm')->name('admin.login-view');
Route::get('/admin/login','App\Http\Controllers\Admin\Auth\LoginController@showAdminLoginForm');
Route::post('/admin','App\Http\Controllers\Admin\Auth\LoginController@adminLogin')->name('admin.login');

Route::get('razorpay',[RazorpayController::class,'index']);
Route::post('razorpay-payment',[RazorpayController::class,'store'])->name('razorpay.payment.store');

//auth route
Route::group(['prefix' => 'admin','middleware' => ['auth:admin']], function () {
    Route::get('/dashboard','App\Http\Controllers\Admin\DashboardController@Index');
    Route::get('/masters','App\Http\Controllers\Admin\MasterController@Index');
    Route::resource('/procedure','App\Http\Controllers\Admin\ProcedureController', ['names' => 'admin.procedure']);
    Route::resource('/procedure-type','App\Http\Controllers\Admin\ProcedureTypeController', ['names' => 'admin.proceduretype']);
    Route::post('/procedure/get-form','App\Http\Controllers\Admin\ProcedureController@ViewForm')->name('admin.view.procedure');
    Route::resource('/lab','App\Http\Controllers\Admin\LabController', ['names' => 'admin.lab']);
    
    Route::post('/lab/get-form','App\Http\Controllers\Admin\LabController@ViewForm')->name('admin.view.lab');

    Route::resource('institution', InstitutionController::class);
    
    Route::delete('/institution/destroy/{id}','App\Http\Controllers\Admin\Master\InstitutionController@destroy');

    Route::any('/edit/institution','App\Http\Controllers\Admin\Master\InstitutionController@InstituteEdit');
    
    Route::get('/view-institution/{id}','App\Http\Controllers\Admin\Master\InstitutionController@view');
    
    Route::post('/check-institution','App\Http\Controllers\Admin\Master\InstitutionController@checkInstitution')->name('admin.check.institution');
    
    Route::post('/check-institutionmail', 'App\Http\Controllers\Admin\Master\InstitutionController@checkInstitutionMail')->name('admin.check.institutionemail');
    Route::post('/check-institutionmobile', 'App\Http\Controllers\Admin\Master\InstitutionController@checkInstitutionMobile')->name('admin.check.institutionmobile');
    
     Route::post('/institution/create','App\Http\Controllers\Admin\Master\InstitutionController@CreateInstitution');
     Route::post('/course/create','App\Http\Controllers\Admin\Master\CourseController@create');
     Route::post('/student/create','App\Http\Controllers\Admin\Master\StudentController@create');
     Route::post('/subscription/create','App\Http\Controllers\Admin\Master\SubscriptionController@create');
    
    
    
    

    Route::resource('student', StudentController::class);
    
     Route::delete('/student/destroy/{id}','App\Http\Controllers\Admin\Master\StudentController@destroy');
    
    Route::any('/edit/student','App\Http\Controllers\Admin\Master\StudentController@EditStudent');
    Route::post('/get/institution-type','App\Http\Controllers\Admin\Master\StudentController@getInstitutionType');
    
    Route::resource('/mac-address','App\Http\Controllers\Admin\MacAddressController', ['names' => 'admin.mac_address']);
    Route::post('/mac-address/get-form','App\Http\Controllers\Admin\MacAddressController@ViewForm')->name('admin.view.mac_address');
   
    Route::resource('course', CourseController::class);

    Route::resource('subscription', SubscriptionController::class);
    
    Route::post('/show-subscription', 'App\Http\Controllers\Admin\Master\SubscriptionController@ShowYearFee')->name('admin.show.subscription');
    
    Route::post('/check-subscription', 'App\Http\Controllers\Admin\Master\SubscriptionController@checkSubscription')->name('admin.check.subscription');
    
    Route::post('/filter-procedure-type','App\Http\Controllers\Admin\MasterController@FilterByType')->name('filter-procedure-type');
    
    Route::post('/logout','App\Http\Controllers\Admin\DashboardController@adminLogout')->name('admin.logout.submit');
    
    Route::get('/profile','App\Http\Controllers\Admin\SettingController@Profile');
    Route::post('/update-profile','App\Http\Controllers\Admin\SettingController@UpdateProfile')->name('admin.update.profile');
    
     Route::post('/update-password','App\Http\Controllers\Admin\SettingController@UpdatePassword')->name('admin.change.password');
    
     Route::get('/terms-and-condition','App\Http\Controllers\Admin\SettingController@TermsSetting');
     Route::post('/store-terms-and-condition','App\Http\Controllers\Admin\SettingController@UpdateSetting')->name('admin.update.settings');
    
      Route::post('/delete-mac-address','App\Http\Controllers\Admin\SettingController@UpdatePassword');
    
    Route::post('/student/paymentdetail','App\Http\Controllers\Student\Auth\DashboardController@paymentdetail')->name('admin.get.payment');
    Route::post('/course-list','App\Http\Controllers\Admin\Master\StudentController@CourseList')->name('admin.get.course-list');

Route::post('/course-years-list','App\Http\Controllers\Admin\Master\StudentController@CourseYearList')->name('admin.get.course-years-list');
    
    
Route::post('/check-mail','App\Http\Controllers\Admin\Master\StudentController@checkMail')->name('admin.check.email');
Route::get('/getregistered-student','App\Http\Controllers\Admin\Master\StudentController@getregisteredinstitution');
Route::get('/getunregistered-student','App\Http\Controllers\Admin\Master\StudentController@getunregisteredinstitution');
    
    
    Route::post('/admin/check-mobile','App\Http\Controllers\Admin\Master\StudentController@checkMobile')->name('admin.check.mobile');
    
    
    
    Route::resource('announcements', AnnouncementsController::class);
    Route::delete('/announcements/delete/{id}', 'App\Http\Controllers\Admin\Master\AnnouncementsController@destroy')->name('announcements.delete');
    Route::post('/show-announcements', 'App\Http\Controllers\Admin\Master\AnnouncementsController@Showannouncements')->name('admin.show.announcements');
    Route::post('/check-announcements', 'App\Http\Controllers\Admin\Master\AnnouncementsController@checkannouncements')->name('admin.check.announcements');
    
    Route::post('/filter-by-month','App\Http\Controllers\Admin\DashboardController@FilterByMonth');

    Route::get('/performance-report','App\Http\Controllers\Admin\ReportController@index');
    
    Route::post('/filter/performance-report','App\Http\Controllers\Admin\ReportController@FilterByStudent');
    
    Route::get('/view-institution-report/{id}','App\Http\Controllers\Admin\ReportController@InstitutionReportView');
    
    Route::post('/filter-institution-top-five','App\Http\Controllers\Admin\ReportController@FilterByProcedure');
    
    Route::post('/get-student-institution','App\Http\Controllers\Admin\ReportController@getStudent');
    
    
    
    
    
   
});