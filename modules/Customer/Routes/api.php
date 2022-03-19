<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\Api\V1\AuthController;

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

Route::middleware('auth:api')->get('/customer', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::post('auth/login_with_firebase', [AuthController::class, 'firebase'])->name('auth.firebase');
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('auth/user', [AuthController::class, 'user'])->name('auth.user');
    });
});
