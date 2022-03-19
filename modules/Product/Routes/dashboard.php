<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Dashboard\ProductAttributeController;
use Modules\Product\Http\Controllers\Dashboard\ProductAttributeValueController;
use Modules\Product\Http\Controllers\Dashboard\ProductCategoryController;
use Modules\Product\Http\Controllers\Dashboard\ProductController;
use Modules\Product\Http\Controllers\Dashboard\ProductTagController;
use Modules\Product\Http\Controllers\Dashboard\ProductVariationController;

Route::prefix('product_attributes/{product_attribute}')->group(function () {
    Route::resource('product_attribute_values', ProductAttributeValueController::class);
});

Route::resources([
    'products'                  => ProductController::class,
    'product_categories'        => ProductCategoryController::class,
    'product_tags'              => ProductTagController::class,
    'product_attributes'        => ProductAttributeController::class,
    'product_variations'        => ProductVariationController::class,
]);
