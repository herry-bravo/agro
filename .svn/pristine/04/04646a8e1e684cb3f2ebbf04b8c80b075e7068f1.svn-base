<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatebmpricelistTable extends Migration
{
    public function up()
    {
        Schema::create('bm_dc_price_list', function (Blueprint $table) {
            $table->increments('id');
			$table->string('price_list_name',15);
			$table->string('description',75);
			$table->date('effective_date');
			$table->string('currency',3);
			$table->string('location_id',15);
			$table->integer('created_by');
			$table->integer('updated_by');
            $table->timestamps();
			$table->softDeletes();
        });
    }
}