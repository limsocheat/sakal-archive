<?php

namespace Modules\Product\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Product\Models\Product;
use Modules\Product\Models\ProductCategory;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        ProductCategory::get()->each(function ($category) {
            $category->forceDelete();
        });
        ProductCategory::factory(5)->create();
        Product::factory(10)->create();
    }
}
