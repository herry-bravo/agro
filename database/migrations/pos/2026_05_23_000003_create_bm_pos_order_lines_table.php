<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmPosOrderLinesTable extends Migration
{
    public function up()
    {
        Schema::create('bm_pos_order_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pos_order_id');
            $table->integer('inventory_item_id')->nullable();
            $table->string('item_code', 50)->nullable();
            $table->string('item_description', 255)->nullable();
            $table->decimal('quantity', 18, 4)->default(1);
            $table->string('uom', 20)->nullable();
            $table->decimal('unit_price', 18, 2)->default(0);
            $table->decimal('discount', 18, 2)->default(0);
            $table->integer('tax_rate')->default(0);
            $table->decimal('subtotal', 18, 2)->default(0);
            $table->decimal('total_line', 18, 2)->default(0);
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bm_pos_order_lines');
    }
}
