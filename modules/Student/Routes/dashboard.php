<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register dashboard routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "dashboard" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use Modules\Student\Http\Controllers\Dashboard\PrintController;
use Modules\Student\Http\Controllers\Dashboard\RegistrationController;
use Modules\Student\Http\Controllers\Dashboard\SettingController;
use Modules\Student\Http\Controllers\Dashboard\StudentController;


Route::resources([
    'students'          => StudentController::class,
    'registrations'     => RegistrationController::class
]);

//print
Route::get('print/student/{student}', [PrintController::class, 'student'])->name('print.student');

Route::get('settings/students', [SettingController::class, 'index'])->name('settings.students.index');
Route::post('settings/students', [SettingController::class, 'store'])->name('settings.students.index');
