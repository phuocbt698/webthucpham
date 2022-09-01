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
        Schema::create('tbl_counpon', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('type')->default(0)->comment('0- trừ %, 1-trừ tiền');
            $table->integer('is_active')->default(0)->comment('0- ẩn, 1-hiển thị');
            $table->integer('value');
            $table->integer('quantity')->nullable();
            $table->timestamp('time_start');
            $table->timestamp('time_end');
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
        Schema::dropIfExists('tbl_counpon');
    }
};
