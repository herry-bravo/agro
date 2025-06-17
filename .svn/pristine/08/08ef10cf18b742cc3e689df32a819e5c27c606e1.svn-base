<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_atp_reply_id', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number',20);
            $table->string('po_line_id',10);
            $table->integer('inventory_item_id');
            $table->string('item_description',240);
            $table->float('atp_qty');
            $table->float('atp_price');
            $table->date('etd_atp');
            $table->date('eta_atp');
            $table->string('reference',120);
            $table->string('attribute1',120);
            $table->integer('intattribute1');
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
        Schema::dropIfExists('atp');
    }
}
