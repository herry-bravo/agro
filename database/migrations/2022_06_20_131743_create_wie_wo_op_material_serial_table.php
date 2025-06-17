<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWieWoOpMaterialSerialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_wie_wo_op_material_serial', function (Blueprint $table) {
            $table->id();
            $table->float('wo_op_material_serial_id')->nullable();
$table->float('object_version_number')->nullable();
$table->float('organization_id')->nullable();
$table->float('work_order_id')->nullable();
$table->float('wo_operation_material_id')->nullable();
$table->float('wo_op_material_lot_id')->nullable();
$table->float('inventory_item_id')->nullable();
$table->string('serial_number',80)->nullable();
$table->float('quantity_usage')->nullable();
$table->string('serial_status',30)->nullable();
$table->string('created_by',64)->nullable();
$table->datetime('creation_date')->nullable();
$table->string('last_updated_by',64)->nullable();
$table->datetime('last_update_date')->nullable();
$table->string('last_update_login',32)->nullable();
$table->string('attribute_category',80)->nullable();
$table->string('attribute_char1',240)->nullable();
$table->string('attribute_char2',240)->nullable();
$table->string('attribute_char20',240)->nullable();
$table->float('attribute_number1')->nullable();
$table->float('attribute_number2')->nullable();
$table->DATE('attribute_date1')->nullable();
$table->DATE('attribute_date2')->nullable();
$table->DATE('attribute_date3')->nullable();
$table->DATE('attribute_date4')->nullable();
$table->DATE('attribute_date5')->nullable();
$table->datetime('attribute_datetime1')->nullable();
$table->float('request_id')->nullable();
$table->string('job_definition_name',100)->nullable();
$table->string('job_definition_package',140)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wie_wo_op_material_serial');
    }
}
