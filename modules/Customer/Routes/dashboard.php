<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\Http\Controllers\Dashboard\CustomerController;

Route::resources([
    'customers' => CustomerController::class,
]);
