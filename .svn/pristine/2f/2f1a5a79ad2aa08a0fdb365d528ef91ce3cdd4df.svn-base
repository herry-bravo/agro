<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_miss_expenses_id', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number',20);
            $table->string('po_line_id',10);
            $table->integer('inventory_item_id');
            $table->string('item_description',240);
            $table->string('attributenumber',20);
            $table->float('intattribute1')->nullable();
            $table->float('intattribute2')->nullable();
            $table->float('intattribute3')->nullable();
            $table->float('intattribute4')->nullable();
            $table->float('intattribute5')->nullable();
            $table->float('intattribute6')->nullable();
            $table->float('intattribute7')->nullable();
            $table->float('intattribute8')->nullable();
            $table->float('intattribute9')->nullable();
            $table->float('intattribute10')->nullable();
            $table->float('intattribute11')->nullable();
            $table->float('intattribute12')->nullable();
            $table->float('rcv_price')->nullable();
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
        Schema::dropIfExists('miss_expense');
    }
}
