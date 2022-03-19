<?php

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

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\Api\V1\AuthController;
use Modules\Student\Http\Controllers\Api\V1\StudentInformationController;

Route::group(['prefix' => 'v1'], function () {

    Route::post('auth/student/register', [AuthController::class, 'register']);
    Route::post('auth/student/login', [AuthController::class, 'login']);

    Route::group(['middleware' => 'auth:sanctum'], function () {
        /** 
         * Authentication 
         * 
         * me
         * logout
         */
        Route::get('auth/student', [AuthController::class, 'index']);
        Route::post('auth/student/logout', [AuthController::class, 'logout']);

        /**
         * Student Information
         * 
         * Information
         */
        Route::get('student/information', [StudentInformationController::class, 'index']);
    });
});
