<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmInvOnhandFgOstd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_inv_onhand_fg_ostd', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('fg_ostd_is');
            $table->integer('compl_reference');
            $table->integer('work_order_id');
            $table->string('work_order_num',50)->nullable();
            $table->integer('sales_reference')->nullable();
            $table->integer('sales_reference_num')->nullable();
            $table->integer('customer_code')->nullable();
            $table->string('customer_po_number',20)->nullable();
            $table->integer('inventory_item_id')->nullable();
            $table->string('item_code',10)->nullable();
            $table->integer('attribute_number_gsm')->nullable();
            $table->integer('attribute_number_w')->nullable();
            $table->integer('attribute_number_l')->nullable();
            $table->integer('ordered_quantity')->nullable();
            $table->string('attribute_quality',10)->nullable();
            $table->integer('attribute_int1')->nullable();
            $table->integer('attribute_int2')->nullable();
            $table->integer('attribute_int3')->nullable();
            $table->string('attribute_char1')->nullable();
            $table->string('attribute_char2')->nullable();
            $table->date('planning_schedule')->nullable();
            $table->date('completed_schedule')->nullable();
            $table->string('status',20)->nullable();
            $table->string('created_by',64)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bm_inv_onhand_fg_ostd');
    }
}
