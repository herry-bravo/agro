<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWieWoOperationMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_wie_wo_operation_materials', function (Blueprint $table) {
            $table->id();
            $table->integer('wo_operation_material_id')->nullable();
$table->float('object_version_float')->nullable();
$table->float('organization_id')->nullable();
$table->float('wo_operation_id')->nullable();
$table->integer('work_order_id')->nullable();
$table->float('material_seq_float')->nullable();
$table->string('material_type',30)->nullable();
$table->float('inventory_item_id')->nullable();
$table->string('item_revision',18)->nullable();
$table->float('quantity_per_product')->nullable();
$table->string('basis_type',30)->nullable();
$table->float('quantity')->nullable();
$table->float('inverse_quantity')->nullable();
$table->string('uom_code',3)->nullable();
$table->datetime('required_date')->nullable();
$table->float('yield_factor')->nullable();
$table->string('include_in_planning_flag',1)->nullable();
$table->string('supply_type',30)->nullable();
$table->string('supply_subinventory',20)->nullable();
$table->float('supply_locator_id')->nullable();
$table->float('issued_quantity')->nullable();
$table->float('produced_quantity')->nullable();
$table->float('picked_quantity')->nullable();
$table->float('allocated_quantity')->nullable();
$table->float('remaining_allocated_quantity')->nullable();
$table->float('tia_ref_line_id')->nullable();
$table->string('tia_ref_entity',30)->nullable();
$table->float('wd_operation_material_id')->nullable();
$table->string('created_by',64)->nullable();
$table->datetime('creation_date')->nullable();
$table->string('last_updated_by',64)->nullable();
$table->datetime('last_update_date')->nullable();
$table->string('last_update_login',32)->nullable();
$table->string('attribute_category',80)->nullable();
$table->string('attribute_char1',240)->nullable();
$table->string('attribute_char2',240)->nullable();
$table->float('attribute_float1')->nullable();
$table->float('attribute_float2')->nullable();
$table->float('attribute_float3')->nullable();
$table->float('attribute_float4')->nullable();
$table->DATE('attribute_date1')->nullable();
$table->DATE('attribute_date2')->nullable();
$table->datetime('attribute_datetime1')->nullable();
$table->datetime('attribute_datetime2')->nullable();
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
        Schema::dropIfExists('wie_wo_operation_materials');
    }
}
