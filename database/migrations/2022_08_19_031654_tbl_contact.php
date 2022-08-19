<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_contact', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->longText('content');
            $table->integer('status')->default(0)->comment('0: Chờ xử lý, 1: Xử lý xong');
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
        Schema::dropIfExists('tbl_contact');
    }
};
