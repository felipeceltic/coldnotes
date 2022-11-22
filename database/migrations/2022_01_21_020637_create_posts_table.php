<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->integer('user_id')->index();
            $table->string('title', 70);
            $table->string('subtitle', 155)->nullable();
            $table->longtext('content');
            $table->string('restored', 15)->nullable();
            $table->longText('history')->nullable();
            $table->timestamps();
            $table->softDeletes();
            // $table->integer('category_id')->nullable();
            // $table->text('tags')->nullable();
            // $table->text('imgs_url')->nullable();
            // $table->text('post_url')->nullable();

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
