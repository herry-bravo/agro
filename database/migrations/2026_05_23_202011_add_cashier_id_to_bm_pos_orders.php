<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCashierIdToBmPosOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bm_pos_orders', function (Blueprint $table) {
            $table->unsignedBigInteger('cashier_id')->nullable()->after('session_id');
        });
    }

    public function down()
    {
        Schema::table('bm_pos_orders', function (Blueprint $table) {
            $table->dropColumn('cashier_id');
        });
    }
}
