<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostPostRemoteMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_post_remote_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('post_remote_media_id');
            $table->timestamps();
            $table->foreign('post_remote_media_id')->references('id')->on('post_remote_media')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_post_remote_media');
    }
}
