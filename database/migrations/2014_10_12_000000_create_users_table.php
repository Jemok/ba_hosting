<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('more_details');
            $table->integer('terms');
            $table->string('hash_id')->unique();
            $table->integer('userCategory');
            $table->boolean('verified');
            $table->integer('investor_finance')->default(0);
            $table->integer('investor_amount');
            $table->integer('moderation_count')->nullable()->default(0);
            $table->string('token')->nullable();
            $table->integer('bongo_request_id');
            $table->integer('investor_request_id');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
