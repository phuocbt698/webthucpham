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
        Schema::create('tbl_configweb', function(Blueprint $table){
            $table->increments('id');
            $table->string('logo');
            $table->string('address')->nullable();
            $table->string('city_id');
            $table->string('district_id');
            $table->string('ward_id');
            $table->string('phone');
            $table->string('email');
            $table->string('facebook');
            $table->string('git');
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
        Schema::dropIfExists('tbl_configweb');
    }
};
