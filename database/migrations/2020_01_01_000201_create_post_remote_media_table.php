<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostRemoteMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_remote_media', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('url');
            $table->text('image')->nullable();
            $table->string('title', 100)->nullable();
            $table->string('alt', 100)->nullable();
            $table->string('type', 20)->nullable();
            $table->string('content_type', 50)->nullable();
            $table->text('grid_image')->nullable();
            $table->float('brightness', 3, 2)->nullable()->default(0);
            $table->string('color', 7)->nullable()->default('#000000');
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
        Schema::dropIfExists('post_remote_media');
    }
}
