<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoheaderTable extends Migration
{
    public function up()
    {
        Schema::create('bm_po_header_all', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('organization_id')->nullable();
            $table->string('created_by',10);
            $table->string('agent_id',10)->nullable();
            $table->integer('type_lookup_code');
			$table->string('vendor_id',10)->nullable();
			$table->string('vendor_site_id',15)->nullable();
            $table->string('ship_to_location',15)->nullable();
            $table->string('bill_to_location',15)->nullable();
            $table->string('segment1',20)->nullable();
			$table->string('currency_code',3)->nullable();
            $table->date('rate_date')->nullable();
            $table->float('rate')->nullable();
            $table->date('effective_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('revision_number')->nullable();
            $table->date('approved_date')->nullable();
            $table->date('closed_date')->nullable();
            $table->integer('cancel_flag')->nullable();
            $table->integer('status')->nullable();
            $table->integer('term_id')->nullable();
            $table->string('ship_via_code',8)->nullable();
            $table->string('description',70)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
