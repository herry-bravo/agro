<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRCVHeaderTable extends Migration
{
    public function up()
    {
        Schema::create('bm_c_rcv_shipment_header_id', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('shipment_header_id')->nullable();
			$table->string('last_updated_by',64)->nullable();
			$table->string('created_by',64)->nullable();
			$table->string('last_update_login',32)->nullable();
			$table->string('receipt_source_code',25)->nullable();
			$table->integer('vendor_id')->nullable();
			$table->integer('vendor_site_id')->nullable();
			$table->integer('organization_id')->nullable();
			$table->string('shipment_num',30)->nullable();
			$table->string('receipt_num',30)->nullable();
			$table->string('ship_to_location_id',15)->nullable();
			$table->string('bill_of_lading',25)->nullable();
			$table->string('packing_slip',25)->nullable();
			$table->date('shipped_date')->nullable();
			$table->integer('freight_carrier_id')->nullable();
			$table->integer('employee_id')->nullable();
			$table->integer('num_of_containers')->nullable();
			$table->string('waybill_airbill_num',20)->nullable();
			$table->string('comments',75)->nullable();
			$table->string('attribute_category',30)->nullable();
			$table->string('attribute1',150)->nullable();
			$table->string('attribute2',150)->nullable();
			$table->integer('attribute_integer1')->nullable();
			$table->date('attribute_date1')->nullable();
			$table->datetime('attribute_datetime1')->nullable();
			$table->integer('request_id')->nullable();
			$table->string('asn_type',25)->nullable();
			$table->string('edi_control_num',10)->nullable();
			$table->date('notice_creation_date')->nullable();
			$table->integer('gross_weight')->nullable();
			$table->string('gross_weight_uom_code',3)->nullable();
			$table->integer('net_weight')->nullable();
			$table->string('net_weight_uom_code',3)->nullable();
			$table->string('freight_terms',25)->nullable();
			$table->string('freight_bill_integer',35)->nullable();
			$table->string('invoice_num',50)->nullable();
			$table->date('invoice_date')->nullable();
			$table->integer('invoice_amount')->nullable();
			$table->string('tax_name',15)->nullable();
			$table->integer('tax_amount')->nullable();
			$table->integer('freight_amount')->nullable();
			$table->string('invoice_status_code',25)->nullable();
			$table->string('asn_status',10)->nullable();
			$table->string('currency_code',15)->nullable();
			$table->string('conversion_rate_type',30)->nullable();
			$table->integer('conversion_rate')->nullable();
			$table->date('conversion_date')->nullable();
			$table->integer('payment_terms_id')->nullable();
			$table->integer('ship_to_org_id')->nullable();
			$table->integer('customer_id')->nullable();
			$table->integer('customer_site_id')->nullable();
			$table->integer('remit_to_site_id')->nullable();
			$table->integer('ship_from_location_id')->nullable();
			$table->string('approval_status',25)->nullable();
			$table->date('gl_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
