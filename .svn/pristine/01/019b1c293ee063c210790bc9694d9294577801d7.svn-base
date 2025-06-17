<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePodetailTable extends Migration
{
    public function up()
    {
        Schema::create('bm_po_lines_all', function (Blueprint $table) {
            $table->increments('line_id');
            $table->integer('po_header_id')->nullable();
            $table->integer('organization_id')->nullable();
            $table->string('line_type_id',10)->nullable();
            $table->integer('created_by_id')->nullable();
            $table->integer('line_number')->nullable();
			$table->integer('inventory_item_id')->nullable();
			$table->string('item_description',120)->nullable();
            $table->string('po_uom_code',3)->nullable();
            $table->float('unit_price')->nullable();
            $table->float('po_quantity')->nullable();
			$table->date('promised_date')->nullable();
            $table->date('need_by_date')->nullable();
            $table->integer('cancel_flag')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('cancel_by')->nullable();
            $table->string('cancel_reason',75)->nullable();
            $table->date('cancel_date')->nullable();
            $table->string('attribute1',75)->nullable();
            $table->string('attribute2',75)->nullable();
            $table->string('attribute3',75)->nullable();
            $table->integer('taxable_flag')->nullable();
            $table->string('tax_name')->nullable();
            $table->float('quantity_receive')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
