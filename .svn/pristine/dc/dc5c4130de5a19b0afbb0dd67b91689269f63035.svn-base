<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemTable extends Migration
{
    public function up()
    {
        Schema::create('bm_mtl_system_item', function (Blueprint $table) {
           
            $table->increments('inventory_item_id');
            $table->string('mapping_item',40)->nullable();
            $table->integer('organization_id')->nullable();
            $table->string('created_by',40)->nullable();
            $table->string('updated_by',40)->nullable();
            $table->string('item_code',40)->unique();
			$table->string('item_brand',40)->nullable();
			$table->string('item_note',60)->nullable();
            $table->string('description',240);
            $table->string('type_code',3)->nullable();
            $table->string('buyer_id',10)->nullable();
			$table->integer('status_id')->nullable();
            $table->integer('purchasing_item_flag')->nullable();
            $table->integer('inventory_item_flag')->nullable();
            $table->string('planner_code',6)->nullable();
            $table->string('primary_uom_code',5)->nullable();
            $table->integer('make_buy_code')->nullable();
            $table->integer('min_o_qty')->nullable();
            $table->integer('max_o_qty')->nullable();
            $table->float('volume')->nullable();
            $table->float('weight')->nullable();
            $table->string('receiving_inventory',8)->nullable();
            $table->string('shipping_inventory',8)->nullable();
            $table->float('packing_quantity')->nullable();
            $table->integer('preprocessing_time')->nullable();
            $table->integer('processing_time')->nullable();
			$table->string('category_code',6)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
