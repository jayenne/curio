<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $options = [
            'layout_options' => array_keys(config('platform.database.boards.layouts.options')),
            'layout_default'  => config('platform.database.boards.layouts.default'),
            'orderby_options' => array_keys(config('platform.database.boards.orderby.options')),
            'orderby_default'  => config('platform.database.boards.orderby.default'),
            'columns_options'  => array_keys(config('platform.database.boards.columns.options')),
            'columns_default'  => config('platform.database.boards.columns.default'),
        ];

        Schema::create('boards', function (Blueprint $table) use ($options) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('title');
            $table->text('body')->nullable();
            $table->enum('layout', $options['layout_options'])->default($options['layout_default']);
            $table->enum('orderby', $options['orderby_options'])->default($options['orderby_default']);
            $table->boolean('direction')->default(0);
            $table->enum('columns', $options['columns_options'])->default($options['columns_default']);
            $table->integer('posts_limit')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('sensitive')->nullable();
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
        Schema::dropIfExists('boards');
    }
}
