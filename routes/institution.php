<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Institution\StudentController;
use App\Http\Controllers\Institution\ProcedureReportController;


Auth::routes();

Route::get('/institution','App\Http\Controllers\Institution\Auth\LoginController@showAdminLoginForm')->name('institution.login-view');
Route::get('/institution/login','App\Http\Controllers\Institution\Auth\LoginController@showAdminLoginForm');

Route::post('/institution','App\Http\Controllers\Institution\Auth\LoginController@institutionLogin')->name('institution.login');

Route::group(['prefix' => 'institution'], function () {
    Route::get('/dashboard','App\Http\Controllers\Institution\Auth\DashboardController@Index')->name('institution.dashboard'); 
    Route::get('/logout','App\Http\Controllers\Institution\Auth\LoginController@logout');
     Route::post('/logout','App\Http\Controllers\Institution\Auth\DashboardController@institutionLogout')->name('institution.logout.submit');
    Route::resource('institution-student', StudentController::class);
    Route::any('/edit/student','App\Http\Controllers\Institution\StudentController@EditStudent');
    Route::post('/get/institution-type','App\Http\Controllers\Institution\StudentController@getInstitutionType');
   Route::post('/student/paymentdetail','App\Http\Controllers\Institution\StudentController@paymentdetail')->name('institution.get.payment');
     Route::post('/course-list','App\Http\Controllers\Institution\StudentController@CourseList')->name('institution.get.course-list');
    Route::post('/course-years-list','App\Http\Controllers\Institution\StudentController@CourseYearList')->name('institution.get.course-years-list');

    Route::post('/check-mail','App\Http\Controllers\Institution\StudentController@checkMail')->name('institution.check.email');
    Route::post('/admin/check-mobile','App\Http\Controllers\Institution\StudentController@checkMobile')->name('institution.check.mobile');
	Route::get('/overall_report','App\Http\Controllers\Institution\ReportController@index');
    Route::get('/student_report/{id}','App\Http\Controllers\Institution\ReportController@studentWiseReport')->name('institution.report.student');
    
    Route::get('/settings','App\Http\Controllers\Institution\SettingController@Profile');

    Route::post('/update-password','App\Http\Controllers\Institution\SettingController@UpdatePassword')->name('institution.change.password');
    
    Route::post('/update-profile','App\Http\Controllers\Institution\SettingController@UpdateProfile')->name('institution.change.profile');
    
    Route::get('/performance-report','App\Http\Controllers\Institution\ReportController@PerformanceReport');
    
    Route::post('/student/create','App\Http\Controllers\Institution\StudentController@create');
    
    Route::get('/students-performance-report','App\Http\Controllers\Institution\ProcedureReportController@index');
     
    Route::post('/filter/performance-report','App\Http\Controllers\Institution\ProcedureReportController@FilterByStudent');
    
     Route::post('/filter/month-report','App\Http\Controllers\Institution\ProcedureReportController@FilterMonthReport');

     Route::get('/view/month-report/{id}/{month}','App\Http\Controllers\Institution\ProcedureReportController@ViewMonthReport');
     Route::get('/view/month-report/{id}/{month}/{procedure_name}','App\Http\Controllers\Institution\ProcedureReportController@ViewMonthReportProcedureWise'); //Added on 29-05-2024
    
     Route::post('/filter-by-procedure','App\Http\Controllers\Institution\Auth\DashboardController@FilterByProcedure'); 
     Route::post('/filter-by-year','App\Http\Controllers\Institution\Auth\DashboardController@FilterByBatchYear'); //Added on 14-05-2024
     Route::post('/filter-by-year-tot','App\Http\Controllers\Institution\Auth\DashboardController@FilterByBatchYearTotalStudents'); //Added on 28-05-2024
     Route::post('/filter-by-year-progress','App\Http\Controllers\Institution\Auth\DashboardController@FilterByProcedureProgress'); //Added on 15-05-2024
    

    
});