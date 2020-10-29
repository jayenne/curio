<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModelViewsTable extends Migration
{
    public function up()
    {
        Schema::create('model_views', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('ip')->nullable();
            $table->string('user_agent')->nullable();
            $table->integer('hits')->unsigned()->default(1);
            $table->integer('model_id')->unsigned()->nullable();
            $table->string('model_type')->nullable();

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('model_views');
    }
}
