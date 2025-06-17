<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCcTable extends Migration
{
    public function up()
    {
        Schema::create('bm_cc_book_all', function (Blueprint $table) {
            $table->increments('id');
			$table->string('cost_center',6);
			$table->string('cc_name',40);
            $table->integer('cc_status');
			$table->integer('created_by');
			$table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
