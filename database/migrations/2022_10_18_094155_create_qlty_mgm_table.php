<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQltyMgmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_mtl_qlty_mgm', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('attribute_aju');
            $table->integer('inventory_item_id');
            $table->string('item_type');
            $table->Float('quantity')->nullable();
            $table->Float('attribute_long')->nullable();
            $table->Float('attribute_short')->nullable();
            $table->Float('attribute_outtrhow')->nullable();
            $table->Float('attribute_prohibitive')->nullable();
            $table->Float('attribute_moisture')->nullable();
            $table->Float('attribute_grade')->nullable();
            $table->Float('intattribute1')->nullable();
            $table->Float('intattribute2')->nullable();
            $table->Float('intattribute3')->nullable();
            $table->Float('intattribute4')->nullable();
            $table->Float('intattribute5')->nullable();
            $table->Float('date_time')->nullable();
            $table->Float('attribute_free')->nullable();
            $table->Float('attribute_gsm')->nullable();
            $table->Float('attribute_thick')->nullable();
            $table->Float('attribute_bright')->nullable();
            $table->Float('attribute_light')->nullable();
            $table->Float('attribute_ash')->nullable();
            $table->Float('attribute_bst')->nullable();
            $table->Float('attribute_rct')->nullable();
            $table->Float('attribute_density')->nullable();
            $table->string('attribute_strength',20)->nullable();
            $table->string('attribute_hydra',20)->nullable();
            $table->string('attribute_note',100)->nullable();
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
        Schema::dropIfExists('qlty_mgm');
    }
}
