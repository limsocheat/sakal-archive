<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Blog\Models\Page;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();

            $table->string('slug')->unique();
            $table->mediumText('title');
            $table->longText('content')->nullable();
            $table->enum('status', [Page::STATUS_DRAFT, Page::STATUS_PUBLISHED])->default(Page::STATUS_DRAFT);
            $table->enum('format', [Page::FORMAT_STANDARD, Page::FORMAT_VIDEO, Page::FORMAT_AUDIO])->default(Page::FORMAT_STANDARD);
            $table->integer('sort_order')->default(0);

            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('pages');
    }
}
