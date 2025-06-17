<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubinventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_mtl_item_sub_inventories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sub_inventory_name',8);
            $table->string('description',50);
            $table->string('locator_type',20);
            $table->string('attribute_category',30);
            $table->string('sub_inventory_group',30)->nullable();
			$table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grn');
    }
}
