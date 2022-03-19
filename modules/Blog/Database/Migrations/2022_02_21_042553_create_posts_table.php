<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Blog\Models\Post;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->index();

            $table->string('slug')->unique();
            $table->mediumText('title');
            $table->longText('content')->nullable();
            $table->enum('status', [Post::STATUS_DRAFT, Post::STATUS_PUBLISHED])->default(Post::STATUS_DRAFT);
            $table->enum('format', [Post::FORMAT_STANDARD, Post::FORMAT_VIDEO, Post::FORMAT_AUDIO])->default(Post::FORMAT_STANDARD);
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
        Schema::dropIfExists('posts');
    }
}
