<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails',function(Blueprint $table){
            $table->increments('id');
            $table->string('to',60);
            $table->string('subject',30)->nullable();
            $table->string('message')->nullable();
            $table->string('state',10)->default('draft');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mails');
    }
}
