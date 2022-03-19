<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();

            $table->foreignId('parent_id')->index()->nullable()->constrained('product_categories')->onUpdate('set null')->onDelete('set null');

            $table->string('slug')->unique();
            $table->mediumText('name');
            $table->longText('description')->nullable();

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
        Schema::dropIfExists('product_categories');
    }
}
