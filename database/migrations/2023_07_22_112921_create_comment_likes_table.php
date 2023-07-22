<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_likes', function (Blueprint $table) {
            $table->id();

            //Add comment_id
            $table->unsignedBigInteger('comment_id')->nullable();
            $table->index('comment_id', 'comment_idx');
            $table->foreign('comment_id', 'comment_liked_fk')->on('comments')->references('id');

            //Add author_id
            $table->unsignedBigInteger('author_id')->nullable();
            $table->index('author_id', 'author_idx');
            $table->foreign('author_id', 'author_liked_post_fk')->on('users')->references('id');

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
        Schema::dropIfExists('comment_likes');
    }
}
