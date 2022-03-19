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
use Modules\Income\Http\Controllers\Dashboard\IncomeCategoryController;
use Modules\Income\Http\Controllers\Dashboard\IncomeController;

Route::resources([
    'incomes'           => IncomeController::class,
    'income_categories' => IncomeCategoryController::class,
]);
