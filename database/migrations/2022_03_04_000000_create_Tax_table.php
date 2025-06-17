<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxTable extends Migration
{
    public function up()
    {
        Schema::create('bm_taxs_id_all', function (Blueprint $table) {
            $table->increments('id');
			$table->string('tax_code',8)->nullable();
			$table->string('tax_regimes_b',50)->nullable();
			$table->string('tax_name',50)->nullable();
			$table->float('tax_rate',)->nullable();
			$table->string('tax_taxes_tl',50)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
