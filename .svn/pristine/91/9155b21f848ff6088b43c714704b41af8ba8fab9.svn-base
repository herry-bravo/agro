<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrxTable extends Migration
{
    public function up()
    {
        Schema::create('bm_trx_statuses', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('trx_code');
			$table->string('trx_name',30);
			$table->string('trx_function',30);
			$table->integer('created_by');
			$table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
