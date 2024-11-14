<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Payment ID
            $table->unsignedBigInteger('user_id'); // User who made the payment
            $table->decimal('amount', 10, 2); // Total amount paid
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending'); // Payment status
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key to the users table
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
