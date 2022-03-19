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
use Modules\Academic\Http\Controllers\Api\V1\AcademicCardController;
use Modules\Academic\Http\Controllers\Api\V1\FacultyController;
use Modules\Academic\Http\Controllers\Api\V1\MajorController;

Route::group(['prefix' => 'v1'], function () {
    Route::get('faculties', [FacultyController::class, 'index']);
    Route::get('faculties/{faculty}', [FacultyController::class, 'show']);
    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::get('academic_cards', [AcademicCardController::class, 'index'])->name('academic_cards.index');
    });
});
