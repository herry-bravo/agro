<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdPlanning extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_prod_planning', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prod_planning_id');
            $table->string('customer_code',10);
            $table->integer('order_number');
            $table->string('customer_po_number',20);
            $table->integer('inventory_item_id');
            $table->string('item_code',10);
            $table->integer('attribute_number_gsm');
            $table->integer('attribute_number_w');
            $table->integer('ordered_quantity');
            $table->date('planning_schedule')->nullable();
            $table->date('completed_schedule')->nullable();
            $table->integer('roll_seq')->nullable();
            $table->integer('revise')->nullable();
            $table->string('status',20)->nullable();
            $table->string('operation_unit',20)->nullable();
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
        Schema::dropIfExists('bm_prod_planning');
    }
}
