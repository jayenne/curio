<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostUrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_urls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('url');
            $table->text('site')->nullable();
            $table->string('title', 255)->nullable();
            $table->text('body')->nullable();
            $table->text('image')->nullable();
            $table->string('alt', 255)->nullable();
            $table->string('locale', '10')->nullable();
            $table->string('type', 30)->nullable();
            $table->text('opengraph')->nullable();
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
        Schema::dropIfExists('post_urls');
    }
}
