<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_cards', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('code')->unique();
            $table->foreignId('student_id')->index()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('faculty_id')->index()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('major_id')->index()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('academic_year_id')->index()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('academic_generation_id')->index()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->dateTime('expired_at')->nullable();
            $table->string('status')->nullable();
            $table->boolean('active')->default(true);
            $table->text('description')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('academic_cards');
    }
}
