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
        Schema::create('tbl_banner', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->string('slug');
            $table->string('path_img');
            $table->string('description');
            $table->integer('type')->default(0)->comment('0: banner, 1: slide');
            $table->integer('is_active')->default(0)->comment('0: Ẩn, 1: Hiển thị');
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
        Schema::dropIfExists('tbl_banner');
    }
};
