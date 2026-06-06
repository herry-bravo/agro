<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmPosOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('bm_pos_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number', 20)->unique();
            $table->integer('session_id');
            $table->string('customer_id', 50)->nullable();
            $table->string('customer_name', 150)->nullable();
            $table->string('org_id', 50)->nullable();
            $table->datetime('order_date');
            $table->decimal('subtotal', 18, 2)->default(0);
            $table->decimal('tax_amount', 18, 2)->default(0);
            $table->decimal('total', 18, 2)->default(0);
            $table->decimal('amount_paid', 18, 2)->default(0);
            $table->decimal('change_amount', 18, 2)->default(0);
            $table->string('status', 20)->default('paid');
            $table->string('so_number', 20)->nullable();
            $table->integer('so_id')->nullable();
            $table->string('invoice_number', 20)->nullable();
            $table->string('delivery_number', 20)->nullable();
            $table->integer('delivery_id')->nullable();
            $table->text('notes')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('last_updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bm_pos_orders');
    }
}
