<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDlvDstbTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_whs_delivery_distb_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('heder_id');
            $table->integer('line_id');
            $table->string('container_item_id',20);
            $table->integer('load_item_id')->nullable();
            $table->float('max_load_quantity')->nullable();
            $table->string('attribute_category',30)->nullable();
            $table->string('attribute1',20)->nullable();
            $table->string('attribute2',20)->nullable();
            $table->string('attribute3',50)->nullable();
            $table->string('job_definition_name',50)->nullable();
            $table->integer('master_organization_id')->nullable();
            $table->string('job_definition_package',20)->nullable();
            $table->integer('preferred_flag')->nullable();
            $table->integer('object_version_number')->nullable();
            $table->string('container_load_code',20)->nullable();
            $table->float('attribute_number1')->nullable();
            $table->float('attribute_number2')->nullable();
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
        Schema::dropIfExists('dlv_dstb');
    }
}
