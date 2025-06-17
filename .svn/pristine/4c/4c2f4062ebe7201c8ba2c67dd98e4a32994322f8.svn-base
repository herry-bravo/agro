<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBMOrderDetTable extends Migration
{
    public function up()
    {
        Schema::create('bm_order_lines_all', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('header_id')->nullable();;
			$table->integer('line_id')->nullable();
			$table->integer('line_number')->nullable();
			$table->float('split_line_id')->nullable();
			$table->integer('inventory_item_id')->nullable();
			$table->string('user_description_item',240)->nullable();
			$table->date('promise_date')->nullable();
			$table->date('request_date')->nullable();
			$table->float('unit_list_price')->nullable();
			$table->float('unit_selling_price')->nullable();
			$table->date('schedule_ship_date')->nullable();
			$table->string('order_quantity_uom',5)->nullable();
			$table->float('pricing_quantity')->nullable();
			$table->float('shipped_quantity')->nullable();
			$table->float('ordered_quantity')->nullable();
			$table->float('fulfilled_quantity')->nullable();
			$table->float('shipping_quantity')->nullable();
			$table->float('shipping_quantity_uom')->nullable();
			$table->float('cancelled_quantity')->nullable();
			$table->string('price_list_id',15)->nullable();
			$table->date('pricing_date')->nullable();
			$table->string('pricing_context',15)->nullable();
			$table->string('pricing_attribute1',15)->nullable();
			$table->integer('item_identifier_type')->nullable();
			$table->integer('shipping_interfaced_flag')->nullable();
			$table->integer('split_from_line_id')->nullable();
			$table->integer('ship_set_id')->nullable();
			$table->integer('split_by')->nullable();
			$table->float('unit_selling_percent')->nullable();
			$table->float('unit_percent_base_price')->nullable();
			$table->date('fulfillment_date')->nullable();
			$table->string('invoice_interface_status_code',20)->nullable();
			$table->float('invoiced_quantity')->nullable();
			$table->string('tax_code',20)->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
    }
}
