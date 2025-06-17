<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoaTable extends Migration
{
    public function up()
    {
        Schema::create('bm_acc_all_id', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_code',8);
            $table->string('description',150)->nullable();;
            $table->string('type',10)->nullable();;
            $table->integer('level')->nullable();;
            $table->timestamps();

            $table->softDeletes();
        });
    }
}
