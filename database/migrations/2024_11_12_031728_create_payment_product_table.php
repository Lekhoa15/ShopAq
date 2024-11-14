<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentProductTable extends Migration
{
    public function up()
    {
        Schema::create('payment_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('payment_id'); // Foreign key to the payments table
            $table->unsignedBigInteger('product_id'); // Foreign key to the products table
            $table->integer('quantity'); // Number of products purchased
            $table->decimal('price', 10, 2); // Price at the time of purchase
            $table->timestamps();

            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_product');
    }
}
