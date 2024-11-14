<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatusColumnInPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('payments', function (Blueprint $table) {
        $table->string('status', 20)->change(); // Tăng độ dài cột status
    });
}

public function down()
{
    Schema::table('payments', function (Blueprint $table) {
        $table->string('status', 10)->change(); // Trả về độ dài cũ nếu cần
    });
}

}
