<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWshdetTable extends Migration
{
    public function up()
    {
        Schema::create('bm_wsh_delivery_details', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('delivery_detail_id');
			$table->string('project_expense_flag',20)->nullable();
			$table->integer('source_header_id')->nullable();
			$table->integer('source_line_id')->nullable();
			$table->string('source_header_number',20)->nullable();
			$table->string('cust_po_number',30)->nullable();
			$table->integer('sold_to_contact_id')->nullable();
			$table->integer('inventory_item_id')->nullable();
			$table->string('item_description',240)->nullable();
			$table->integer('ship_from_location_id')->nullable();
			$table->integer('organization_id')->nullable();
			$table->integer('ship_to_location_id')->nullable();
			$table->integer('src_requested_quantity')->nullable();
			$table->string('src_requested_quantity_uom',6)->nullable();
			$table->float('cancelled_quantity')->nullable();
			$table->float('requested_quantity')->nullable();
			$table->string('requested_quantity_uom')->nullable();
			$table->float('shipped_quantity')->nullable();
			$table->float('delivered_quantity')->nullable();
			$table->float('cycle_count_quantity')->nullable();
			$table->integer('move_order_line_id')->nullable();
			$table->string('subinventory',8)->nullable();
			$table->string('revision',3)->nullable();
			$table->string('lot_number',10)->nullable();
			$table->string('released_status',20)->nullable();
			$table->string('serial_number',15)->nullable();
			$table->date('date_requested')->nullable();
			$table->date('date_scheduled')->nullable();
			$table->integer('customer_item_id')->nullable();
			$table->integer('net_weight')->nullable();
			$table->string('weight_uom_code',3)->nullable();
			$table->integer('volume')->nullable();
			$table->integer('org_id')->nullable();
			$table->string('attribute1',240)->nullable();
			$table->string('attribute2',240)->nullable();
			$table->string('created_by',5)->nullable();
			$table->integer('gross_weight')->nullable();
			$table->integer('unit_price')->nullable();
			$table->string('currency_code',3)->nullable();
			$table->integer('ship_to_site_use_id')->nullable();
			$table->float('picked_quantity')->nullable();
			$table->integer('unit_weight')->nullable();
			$table->integer('unit_volume')->nullable();
			$table->integer('ship_to_party_id')->nullable();
			$table->integer('sold_to_party_id')->nullable();
			$table->integer('bill_to_party_id')->nullable();
			$table->integer('bill_to_location_id')->nullable();
			$table->integer('bill_to_contact_id')->nullable();
			$table->string('ship_set_name',50)->nullable();
			$table->integer('source_shipment_id')->nullable();
			$table->string('source_shipment_number',20)->nullable();
			$table->string('sales_order_number',10)->nullable();
			$table->string('conversion_type',15)->nullable();
			$table->DATE('conversion_date')->nullable();
			$table->string('spq_uom')->nullable();
			$table->integer('rcv_shipment_line_id')->nullable();
			$table->float('intattribute1')->nullable();
			$table->float('intattribute2')->nullable();
			$table->float('intattribute3')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
