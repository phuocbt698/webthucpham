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
        Schema::create('tbl_vendor', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('email');
            $table->string('phone');
            $table->string('path_image');
            $table->string('website');
            $table->string('city_id');
            $table->string('district_id');
            $table->string('ward_id');
            $table->integer('is_active')->default(0)->comment('0: Ẩn, 1: Hiển thị');
            $table->timestamps();
            $table->foreign('city_id')
                    ->references('id')
                    ->on('tbl_city');
            $table->foreign('district_id')
                    ->references('id')
                    ->on('tbl_district');
            $table->foreign('ward_id')
                    ->references('id')
                    ->on('tbl_ward');
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
