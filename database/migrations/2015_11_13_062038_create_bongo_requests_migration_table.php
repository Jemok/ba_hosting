<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBongoRequestsMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bongo_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bongo_email')->unique();
            $table->string('company');
            $table->string('job_title');
            $table->string('field');
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
        Schema::drop('bongo_requests');
    }
}
