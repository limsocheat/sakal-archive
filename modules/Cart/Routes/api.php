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
use Modules\Cart\Http\Controllers\Api\V1\CartController;

Route::group(['prefix' => 'v1', 'as' => 'api.v1.'], function () {
    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('carts', [CartController::class, 'index'])->name('carts.index');
    });
});
