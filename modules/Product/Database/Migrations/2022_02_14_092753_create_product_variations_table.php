<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->index()->nullable()->constrained()->onUpdate('set null')->onDelete('set null');
            $table->foreignId('product_attribute_id')->index()->nullable()->constrained()->onUpdate('set null')->onDelete('set null');
            $table->foreignId('product_attribute_value_id')->index()->nullable()->constrained()->onUpdate('set null')->onDelete('set null');
            $table->double('price')->nullable()->default(null);
            $table->integer('sort_order');
            $table->json('settings')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
}
