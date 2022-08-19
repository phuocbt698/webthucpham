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
        Schema::create('tbl_category', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->unsignedInteger('parent_id');
            $table->integer('is_active')->default(0)->comment('0: Ẩn, 1: Hiển thị');
            $table->timestamps();
            $table->foreign('parent_id')
                    ->references('id')
                    ->on('tbl_category');
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
};
