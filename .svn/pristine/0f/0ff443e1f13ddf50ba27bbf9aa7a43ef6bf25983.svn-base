<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTermTable extends Migration
{
    public function up()
    {
        Schema::create('bm_global_terms_all', function (Blueprint $table) {
            $table->increments('id');
            $table->string('term_category',25);
			$table->string('term_code',6);
            $table->string('terms_name',50);    
            $table->string('attribute1',50);
            $table->integer('creted_by');
            $table->integer('updated_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
