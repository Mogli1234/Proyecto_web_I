<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mail_user',function(Blueprint $table){
                $table->increments('id');
                $table->integer('mail_id');
                $table->integer('log_user_id');
                $table->integer('to_user_id');

                $table->foreign('mail_id')->references('id')->on('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
