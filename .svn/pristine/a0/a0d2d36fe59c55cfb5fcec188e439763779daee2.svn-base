<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBMOrderTable extends Migration
{
    public function up()
    {
        Schema::create('bm_order_headers_all', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('header_id');
			$table->string('org_id',3)->nullable();
			$table->integer('order_type_id')->nullable();
			$table->string('order_number')->nullable();
			$table->integer('version_number')->nullable();
			$table->date('expiration_date')->nullable();
			$table->integer('order_source_id')->nullable();
			$table->integer('source_document_type_id')->nullable();
			$table->integer('orig_sys_document_ref')->nullable();
			$table->integer('source_document_id')->nullable();
			$table->string('user_item_description',240)->nullable();
			$table->date('ordered_date')->nullable();
			$table->date('request_date')->nullable();
			$table->date('pricing_date')->nullable();
			$table->integer('shipment_priority_code')->nullable();
			$table->integer('demand_class_code')->nullable();
			$table->string('price_list_id',15)->nullable();
			$table->string('attribute1',240)->nullable();
			$table->string('attribute2',240)->nullable();
			$table->string('attribute3',240)->nullable();
			$table->integer('tax_exempt_flag')->nullable();
			$table->integer('tax_exempt_number')->nullable();
			$table->integer('tax_exempt_reason_code')->nullable();
			$table->float('conversion_rate')->nullable();
			$table->integer('conversion_type_code')->nullable();
			$table->integer('conversion_rate_date')->nullable();
			$table->integer('partial_shipments_allowed')->nullable();
			$table->integer('freight_terms_code')->nullable();
			$table->string('cust_po_number',60)->nullable();
			$table->string('sold_from_org_id',3)->nullable();
			$table->string('sold_to_org_id',3)->nullable();
			$table->string('ship_from_org_id',)->nullable();
			$table->string('ship_to_org_id',15)->nullable();
			$table->string('invoice_to_org_id',15)->nullable();
			$table->string('deliver_to_org_id',15)->nullable();
			$table->integer('created_by')->nullable();
			$table->integer('updated_by')->nullable();
			$table->integer('cancelled_flag')->nullable();
			$table->integer('open_flag')->nullable();
			$table->integer('booked_flag')->nullable();
			$table->string('customer_payment_term_id',15)->nullable();
            $table->timestamps();
			$table->softDeletes();
        });
    }
}
