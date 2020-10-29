<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSocialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $status = config('platform.database.posts.status');

        Schema::create('user_socials', function (Blueprint $table) use ($status) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('service', 20)->nullable();
            $table->string('social_id')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('nickname', 20)->nullable();
            $table->string('avatar', 2048)->nullable();
            $table->string('cover', 2048)->nullable();
            $table->string('description', 2048)->nullable();
            $table->string('url', 2048)->nullable();
            $table->string('location', 100)->nullable();
            $table->boolean('following')->default(false);
            $table->boolean('suspended')->default(false);
            $table->string('token')->nullable();
            $table->string('token_secret')->nullable();
            $table->boolean('destroy')->nullable()->default(true);
            $table->enum('status', $status['options'])->default($status['default']);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        
        Schema::dropIfExists('user_socials');
        
        Schema::enableForeignKeyConstraints();
    }
}
