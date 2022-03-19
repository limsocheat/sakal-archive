<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Vendor\Models\Vendor;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();

            $table->enum('type', [Vendor::TYPE_PERSON, Vendor::TYPE_COMPANY])->default(Vendor::TYPE_PERSON);

            $table->string('legal_name')->nullable();
            $table->string('company_name')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('display_name')->nullable();

            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('house_number')->nullable();
            $table->string('address')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->text('description')->nullable();

            $table->boolean('active')->default(true);
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
        Schema::dropIfExists('vendors');
    }
}
