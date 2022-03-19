<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Product\Models\Product;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();

            $table->foreignId('product_brand_id')->index()->nullable()->constrained('product_brands')->onUpdate('set null')->onDelete('set null');

            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->mediumText('name');
            $table->longText('description')->nullable();

            $table->enum('type', [
                Product::TYPE_SIMPLE,
                Product::TYPE_VARIABLE
            ])->default(Product::TYPE_SIMPLE);

            $table->decimal('weight', 8, 2)->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('sale_price', 8, 2)->nullable();

            $table->boolean('active')->default(true);
            $table->integer('sort_order');
            $table->json('settings')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
