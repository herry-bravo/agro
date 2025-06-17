<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeTable extends Migration
{
    public function up()
    {
        Schema::create('bm_item_types', function (Blueprint $table) {
           
            $table->increments('inventory_item_id');
            $table->string('type_code',3);
            $table->string('type_name',40);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
