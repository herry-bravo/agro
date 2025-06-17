<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImgPathTable extends Migration
{
    public function up()
    {
        Schema::create('bm_img_path', function (Blueprint $table) {

		$table->id('id');
		$table->integer('aju',);
		$table->string('path');
        $table->timestamps();
        $table->softDeletes();

        });
    }

    public function down()
    {
        Schema::dropIfExists('bm_img_path');
    }
}
