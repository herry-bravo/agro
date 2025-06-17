<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnhandTable extends Migration
{
    public function up()
    {
        Schema::create('bm_onhand_quantities_detail', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('inventory_item_id')->nullable();

            $table->integer('item_primary_uom_code')->nullable();

            $table->float('transaction_quantity')->nullable();

            $table->integer('subinvetory_id')->nullable();

            $table->string('segment1')->nullable();

            $table->string('attribute')->nullable();

            $table->datetime('creation_date')->nullable();

            $table->datetime('update_at')->nullable();

            $table->string('created_by')->nullable();

            $table->string('updated_by')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
