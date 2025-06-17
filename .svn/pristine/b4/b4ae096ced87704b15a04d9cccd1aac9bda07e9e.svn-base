<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmPlanningDetailId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_planning_detail_id', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('header_id');
            $table->integer('line_id');
            $table->integer('line_number');
            $table->integer('inventory_item_id');
            $table->string('item_description',20);
            $table->integer('attribute_gsm_line');
            $table->integer('attribute_w_line');
            $table->integer('total_roll_by_line')->nullable();
            $table->integer('qty_estimation')->nullable();
            $table->integer('total_qty')->nullable();
            $table->string('status',20)->nullable();
            $table->string('operation_unit',20)->nullable();
            $table->string('created_by',64)->nullable();
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
        Schema::dropIfExists('bm_planning_detail_id');
    }
}
