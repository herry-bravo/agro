<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmInvUomConversionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_inv_uom_conversions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conversion_id');
            $table->integer('inventory_item_id');
            $table->string('uom_code',10);
            $table->string('contained_uom_code',30)->nullable();
            $table->string('uom_class',20);
            $table->float('conversion_rate');
            $table->integer('default_conversion_flag');
            $table->string('interior_unit_code',10);
            $table->float('interior_unit_qty');
            $table->date('disable_date');
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
        Schema::dropIfExists('bm_inv_uom_conversions');
    }
}
