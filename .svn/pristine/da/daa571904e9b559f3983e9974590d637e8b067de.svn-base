<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGsmStd extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_gsm_std_id', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inventory_item_id');
            $table->string('item_description');
            $table->float('gsm');
            $table->float('value');
            $table->string('operation',10);
            $table->integer('org_id')->nullable();
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
        Schema::dropIfExists('gsm_std');
    }
}
