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
        Schema::create('tbl_order_detail', function(Blueprint $table){
            $table->increments('id');
            $table->string('product_name');
            $table->unsignedInteger('product_id');
            $table->string('path_image');
            $table->unsignedInteger('product_price');
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('order_id');
            $table->integer('total_price');
            $table->timestamps();
            $table->foreign('product_id')
                    ->references('id')
                    ->on('tbl_product');
            $table->foreign('order_id')
                    ->references('id')
                    ->on('tbl_order');
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
        Schema::dropIfExists('tbl_order_detail');
        Schema::dropIfExists('tbl_order');
    }
};
