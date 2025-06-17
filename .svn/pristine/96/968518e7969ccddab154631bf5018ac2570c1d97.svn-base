<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatebmpricelistdetTable extends Migration
{
    public function up()
    {
        Schema::create('bm_dc_price_list_lines', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('header_id');
			$table->integer('line_id');
			$table->integer('inventory_item_id');
			$table->string('user_item_description',240);
			$table->string('uom',3);
			$table->float('unit_price');
			$table->float('discount');
			$table->string('packing_type');
			$table->date('effective_from');
			$table->date('effective_to');
			$table->integer('created_by');
			$table->integer('updated_by');
            $table->timestamps();
			$table->softDeletes();
        });
    }
}