<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $options = [
            'account_type_default' => config('platform.database.users.account_types.default'),
            'account_type_options' => array_keys(config('platform.database.users.account_types.options')),
        ];
        Schema::create('users', function (Blueprint $table) use ($options) {
            //$table->uuid('id')->primary();
            $table->bigIncrements('id');
            //$table->uuid('uuid')->index()->unique();
            $table->string('name')->nullable();
            $table->string('username')->unique()->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('activation_token', 100)->default(Str::random(60));
            $table->enum('account_type', $options['account_type_options'])->default($options['account_type_default']);
            $table->rememberToken();
            $table->timestampsTz();
            $table->softDeletesTz();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('login_at')->nullable();
            $table->timestamp('active_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
