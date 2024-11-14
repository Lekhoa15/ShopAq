<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePaymentsTableAddStripeChargeIdAndStatusEnum extends Migration
{
    public function up()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Thêm cột stripe_charge_id
            $table->string('stripe_charge_id')->nullable();

            // Đổi kiểu cột status thành enum với các trạng thái mới
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('payments', function (Blueprint $table) {
            // Xóa cột stripe_charge_id
            $table->dropColumn('stripe_charge_id');

            // Đổi lại kiểu cột status về trạng thái ban đầu
            $table->enum('status', ['pending', 'completed', 'failed'])->default('pending')->change();
        });
    }
}
