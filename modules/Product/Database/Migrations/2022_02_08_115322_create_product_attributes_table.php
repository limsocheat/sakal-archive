<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Product\Models\ProductAttribute;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();

            $table->string('slug')->unique();
            $table->mediumText('name');
            $table->longText('description')->nullable();
            $table->enum('type', [
                ProductAttribute::TYPE_SELECT,
                ProductAttribute::TYPE_RADIO,
                ProductAttribute::TYPE_COMBO,
                ProductAttribute::TYPE_CHECKBOX,
                ProductAttribute::TYPE_COLOR,
                ProductAttribute::TYPE_IMAGE,
            ])->default(ProductAttribute::TYPE_SELECT);

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
        Schema::dropIfExists('product_attributes');
    }
}
