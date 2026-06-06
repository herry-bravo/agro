<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmPosPaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('bm_pos_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pos_order_id');
            $table->string('payment_method', 20);
            $table->decimal('amount', 18, 2)->default(0);
            $table->string('reference_number', 100)->nullable();
            $table->text('notes')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bm_pos_payments');
    }
}
