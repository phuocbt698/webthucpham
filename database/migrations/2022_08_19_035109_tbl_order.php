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
        Schema::create('tbl_order', function(Blueprint $table){
            $table->increments('id');
            $table->string('code');
            $table->string('member');
            $table->string('email');
            $table->string('phone');
            $table->integer('total_price');
            $table->integer('status')->default(0)->comment('0: Mới, 1: Giao hàng, 2: Hoàn thành, 3: Hủy');
            $table->text('note');
            $table->text('address');
            $table->string('city_id');
            $table->string('district_id');
            $table->string('ward_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();
            $table->foreign('user_id')
                    ->references('id')
                    ->on('tbl_user');
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
