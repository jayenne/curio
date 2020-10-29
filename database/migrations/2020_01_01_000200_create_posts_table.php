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
        $postTypes = config('platform.database.posts.types.options');
        $postTypesDefault = config('platform.database.posts.types.default');
        $postThemes = config('platform.database.posts.themes.options');
        $postThemesDefault = config('platform.database.posts.themes.default');

        Schema::create('posts', function (Blueprint $table) use ($postTypes, $postTypesDefault, $postThemes, $postThemesDefault) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->text('title')->nullable();
            $table->text('text')->nullable();
            $table->text('text_alt')->nullable();
            $table->text('notes')->nullable();
            $table->string('lang', 4)->nullable();
            $table->enum('type', $postTypes)->default($postTypesDefault)->nullable();
            $table->enum('theme', $postThemes)->default($postThemesDefault);
            $table->unsignedBigInteger('source_id')->nullable();
            $table->unsignedBigInteger('source_user_id')->nullable();
            $table->string('source_platform_id')->nullable();
            $table->string('source_permalink')->nullable();
            $table->mediumText('source_payload')->nullable();
            $table->boolean('sensitive')->nullable();
            $table->unsignedBigInteger('index')->nullable();
            $table->float('index_x', 3, 2)->nullable();
            $table->string('hash', 32)->unique()->nullable();
            $table->dateTimeTz('posted_at')->nullable();
            $table->timestampsTz();
            $table->softDeletesTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('posts');
        Schema::enableForeignKeyConstraints();
    }
}
