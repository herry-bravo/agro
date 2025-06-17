<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsrlogactivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usrlogactivity', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id',20)->nullable();
            $table->string('login_ip',20)->nullable();
            $table->string('attribute1',100)->nullable();
            $table->datetime('login_date')->nullable();
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
        Schema::dropIfExists('usrlogactivity');
    }
}
