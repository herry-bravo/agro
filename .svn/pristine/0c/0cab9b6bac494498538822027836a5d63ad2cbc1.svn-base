<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvAdtTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_inv_onhand_fg_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_item_id');
            $table->string('uniq_attribute_roll',20);
            $table->float('attribute_number_gsm')->nullable();
            $table->float('attribute_number_l')->nullable();
            $table->float('attribute_number_w')->nullable();
            $table->string('primary_uom',3);
            $table->float('primary_quantity');
            $table->float('secondary_quantity');
            $table->string('attribute_num_quality',10)->nullable();
            $table->integer('shipping_status_flag');
            $table->integer('wip_status_flag');
            $table->string('reference',50)->nullable();
            $table->date('completion_date');
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
        Schema::dropIfExists('inv_adt');
    }
}
