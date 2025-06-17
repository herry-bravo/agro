<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmMtlMaterialTrnTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_mtl_material_trn_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trx_code');
            $table->string('trx_types', 50);
            $table->string('trx_actions', 50);
            $table->string('trx_source_types', 51);
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
        Schema::dropIfExists('bm_mtl_material_trn_types');
    }
}
