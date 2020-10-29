<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostPostUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_post_urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('post_urls_id');
            $table->timestamps();

            $table->foreign('post_urls_id')->references('id')->on('post_urls')->onDelete('cascade');
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
        Schema::dropIfExists('post_post_urls');
    }
}
