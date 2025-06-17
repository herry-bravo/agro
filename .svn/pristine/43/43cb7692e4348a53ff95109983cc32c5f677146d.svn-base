<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWshTable extends Migration
{
    public function up()
    {
        Schema::create('bm_wsh_new_deliveries', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('delivery_id');
			$table->string('delivery_name',30)->nullable();
			$table->string('planned_flag',1)->nullable();
			$table->string('status_code',2)->nullable();
			$table->string('freight_terms_code',30)->nullable();
			$table->string('fob_code',15)->nullable();
			$table->string('acceptance_flag',1)->nullable();
			$table->string('accepted_by',10)->nullable();
			$table->date('accepted_date')->nullable();
			$table->string('confirmed_by',10)->nullable();
			$table->string('description',150)->nullable();
			$table->integer('gross_weight')->nullable();
			$table->integer('net_weight')->nullable();
			$table->string('weight_uom_code',10)->nullable();
			$table->integer('volume')->nullable();
			$table->string('bill_freight_to',20)->nullable();
			$table->string('carried_by',20)->nullable();
			$table->string('attribute_category',150)->nullable();
			$table->string('attribute1',150)->nullable();
			$table->string('attribute2',150)->nullable();
			$table->string('created_by',150)->nullable();
			$table->string('last_updated_by',150)->nullable();
			$table->string('last_update_login',150)->nullable();
			$table->date('confirm_date')->nullable();
			$table->string('ship_method_code',150)->nullable();
			$table->string('dock_code',150)->nullable();
			$table->string('delivery_type',150)->nullable();
			$table->string('currency_code',3)->nullable();
			$table->integer('organization_id')->nullable();
			$table->integer('ship_to_party_id')->nullable();
			$table->integer('sold_to_party_id')->nullable();
			$table->date('actual_ship_date')->nullable();
			$table->string('packing_slip_number')->nullable();
            $table->integer('level')->nullable();
            $table->integer('lvl')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
