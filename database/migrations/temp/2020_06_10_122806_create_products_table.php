<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('keywords')->nullable();
            $table->string('brand')->nullable();
            $table->string('sold_by')->nullable();
            $table->decimal('price',8,2,true)->nullable();
            $table->decimal('price_to_pay',8,2,true)->nullable();
            $table->integer('max_order')->nullable();
            $table->longText('description')->nullable();
            $table->integer('total')->nullable();
            //$table->string('color');
            //$table->string('size');
            $table->string('coupon')->nullable();
            $table->string('review_type')->nullable();
            $table->string('refund_type')->nullable();
            $table->decimal('commission',8,2,true)->nullable();
            $table->longText('instructions')->nullable();
            $table->longText('product_links')->nullable();
            $table->string('asin')->nullable();
            $table->integer('no_of_rating')->nullable();
            $table->bigInteger('seller_id');
            $table->foreign('seller_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
