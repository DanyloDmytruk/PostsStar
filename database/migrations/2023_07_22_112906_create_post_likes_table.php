<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_likes', function (Blueprint $table) {
            $table->id(); //Like id

            //Add post_id
            $table->unsignedBigInteger('post_id')->nullable();
            $table->index('post_id', 'post_idx');
            $table->foreign('post_id', 'post_liked_fk')->on('posts')->references('id');

            //Add author_id
            $table->unsignedBigInteger('author_id')->nullable();
            $table->index('author_id', 'author_idx');
            $table->foreign('author_id', 'author_liked_fk')->on('users')->references('id');

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
        Schema::dropIfExists('post_likes');
    }
}
