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
use Modules\Blog\Http\Controllers\Dashboard\CategoryController;
use Modules\Blog\Http\Controllers\Dashboard\PageController;
use Modules\Blog\Http\Controllers\Dashboard\PostController;
use Modules\Blog\Http\Controllers\Dashboard\TagController;
use Modules\Blog\Http\Controllers\Dashboard\ToolWixController;

Route::resources([
    'posts'         => PostController::class,
    'categories'    => CategoryController::class,
    'tags'          => TagController::class,
    'pages'         => PageController::class,
]);

Route::get('tools/wix_import', [ToolWixController::class, 'index'])->name('tools.wix_import');
Route::get('tools/wix_import/posts', [ToolWixController::class, 'posts'])->name('tools.wix_import.posts');
Route::get('tools/wix_import/categories', [ToolWixController::class, 'categories'])->name('tools.wix_import.categories');
