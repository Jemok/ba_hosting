<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInnovationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('innovations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('innovationTitle');
            $table->text('innovationDescription');
            $table->integer('innovationFund');
            $table->string('tradeMarkName')->nullable();
            $table->string('tradeMarkNumber')->nullable();
            $table->text('justifyFund');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->integer('fund_id');
            $table->integer('fundingStatus')->default(0);
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
        Schema::drop('innovations');
    }
}
