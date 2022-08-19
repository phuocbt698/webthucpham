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
        Schema::create('tbl_member', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('path_img');
            $table->string('phone');
            $table->text('address');
            $table->string('city_id');
            $table->string('district_id');
            $table->string('ward_id');
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
        Schema::dropIfExists('tbl_member');
    }
};