<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Student\AuthController;
use App\Http\Controllers\Api\Student\ProcedureApiController;
use App\Http\Controllers\Api\Student\ScoreController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/student/login',[AuthController::class,'login']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/student/logout',[AuthController::class,'logout']);
    Route::post('/student/profile',[AuthController::class,'profile']);
    Route::post('/student/procedures',[ProcedureApiController::class,'procedures']);
    Route::post('/student/add-score',[ScoreController::class,'StoreScore']);
    
});

