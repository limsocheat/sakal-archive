<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ModuleController;
use App\Http\Controllers\Dashboard\PermissionController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\Settings\GeneralSettingController;
use App\Http\Controllers\Dashboard\Settings\MailSettingController;
use App\Http\Controllers\Dashboard\Settings\SettingController;
use App\Http\Controllers\Dashboard\Tools\ToolController;
use App\Http\Controllers\Dashboard\UpdateController;
use App\Http\Controllers\Dashboard\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index'])->name('index');

Route::resources([
    'users'         => UserController::class,
    'roles'         => RoleController::class,
    'permissions'   => PermissionController::class,
]);

Route::get('/modules', [ModuleController::class, 'index'])->name('modules.index');
Route::post('/modules/{module}/enable', [ModuleController::class, 'enable'])->name('modules.enable');
Route::post('/modules/{module}/disable', [ModuleController::class, 'disable'])->name('modules.disable');

Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');

Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
Route::get('/settings/general', [GeneralSettingController::class, 'index'])->name('settings.general.index');
Route::post('/settings/general', [GeneralSettingController::class, 'store'])->name('settings.general.store');
Route::get('/settings/mail', [MailSettingController::class, 'index'])->name('settings.mail.index');
Route::post('/settings/mail', [MailSettingController::class, 'store'])->name('settings.mail.store');

Route::get('/updates', [UpdateController::class, 'index'])->name('updates.index');
