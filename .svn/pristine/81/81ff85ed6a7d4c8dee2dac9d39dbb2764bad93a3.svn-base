<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnhandTable extends Migration
{
    public function up()
    {
        Schema::create('bm_inv_onhand_quantities_detail', function (Blueprint $table) {
			$table->increments('id');
            $table->integer('inventory_item_id');
			$table->string('standard_pack_uom',3)->nullable();
			$table->integer('standard_pack_quantity')->nullable();
			$table->integer('organization_id')->nullable();
			$table->DATE('date_received')->nullable();
			$table->datetime('last_update_date')->nullable();
			$table->string('last_updated_by',64)->nullable();
			$table->datetime('creation_date')->nullable();
			$table->string('created_by',64)->nullable();
			$table->string('last_update_login',32)->nullable();
			$table->integer('primary_transaction_quantity')->nullable();
			$table->string('subinventory_code',10)->nullable();
			$table->string('revision',18)->nullable();
			$table->integer('locator_id')->nullable();
			$table->integer('create_transaction_id')->nullable();
			$table->integer('update_transaction_id')->nullable();
			$table->string('lot_number',80)->nullable();
			$table->DATE('orig_date_received')->nullable();
			$table->integer('onhand_quantities_id')->nullable();
			$table->string('transaction_uom_code',3)->nullable();
			$table->integer('transaction_quantity')->nullable();
			$table->string('secondary_uom_code',3)->nullable();
			$table->integer('secondary_transaction_quantity')->nullable();
			$table->integer('orig_source_txn_id')->nullable();
			$table->string('owning_type',30)->nullable();
			$table->integer('owning_entity_id')->nullable();
			$table->DATE('aging_onset_date')->nullable();
			$table->DATE('aging_expiration_date')->nullable();
			$table->string('inv_striping_category',40)->nullable();
			$table->integer('project_id')->nullable();
			$table->integer('task_id')->nullable();
			$table->string('country_of_origin_code',2)->nullable();
			$table->string('inv_reserved_attribute1',150)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
