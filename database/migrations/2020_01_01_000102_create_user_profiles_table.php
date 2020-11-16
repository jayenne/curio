<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('nickname', 50)->nullable();
            $table->string('title', 50)->nullable();
            $table->string('body', 160)->nullable();
            $table->string('url', 100)->nullable();
            $table->string('location', 30)->nullable();
            $table->enum('sex', ['male', 'female'])->nullable();
            $table->string('gender', 20)->nullable();
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

        Schema::dropIfExists('user_profiles');

        Schema::enableForeignKeyConstraints();
    }
}
