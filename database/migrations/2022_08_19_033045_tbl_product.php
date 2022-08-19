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
        Schema::create('tbl_product', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('stock');
            $table->integer('price');
            $table->string('path_image');
            $table->integer('is_hot')->default(0)->comment('0: , 1: Mới');
            $table->integer('is_active')->default(0)->comment('0: Ẩn, 1: Hiển thị');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('vendor_id');
            $table->unsignedInteger('user_id');
            $table->longText('description');
            $table->timestamps();
            $table->foreign('category_id')
                    ->references('id')
                    ->on('tbl_category');
            $table->foreign('brand_id')
                    ->references('id')
                    ->on('tbl_brand');
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
        Schema::dropIfExists('tbl_product');
        Schema::dropIfExists('tbl_category');
        Schema::dropIfExists('tbl_brand');
        Schema::dropIfExists('tbl_vendor');
    }
};
