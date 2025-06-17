<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUomTable extends Migration
{
    public function up()
    {
        Schema::create('bm_unit_of_measurement', function (Blueprint $table) {
           
            $table->increments('id');
            $table->string('uom_code',3)->nullable();
            $table->string('uom_name',40);
			$table->string('description',40)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
