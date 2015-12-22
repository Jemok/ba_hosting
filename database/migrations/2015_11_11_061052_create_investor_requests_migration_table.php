<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestorRequestsMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investor_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('investor_email')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('company');
            $table->string('job_title');
            $table->integer('request_status')->default(0);
            $table->string('request_link')->unique();
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
        Schema::drop('investor_requests');
    }
}
