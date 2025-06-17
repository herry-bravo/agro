<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWieWorkOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_wie_work_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('work_order_id')->nullable();
            $table->float('object_version_float')->nullable();
            $table->float('organization_id')->nullable();
            $table->string('work_order_number',120)->nullable();
            $table->float('work_method_id')->nullable();
            $table->string('work_order_type',30)->nullable();
            $table->string('work_order_sub_type',30)->nullable();
            $table->float('inventory_item_id')->nullable();
            $table->string('item_revision',18)->nullable();
            $table->float('item_version')->nullable();
            $table->string('item_structure_name',80)->nullable();
            $table->float('transform_from_item_id')->nullable();
            $table->datetime('work_definition_as_of_date')->nullable();
            $table->float('work_definition_id')->nullable();
            $table->float('work_definition_version_id')->nullable();
            $table->float('work_order_priority')->nullable();
            $table->float('work_order_status_id')->nullable();
            $table->string('scheduling_method',30)->nullable();
            $table->float('planned_start_quantity')->nullable();
            $table->float('nettable_supply_qty_override')->nullable();
            $table->string('uom_code',3)->nullable();
            $table->float('primary_product_quantity')->nullable();
            $table->string('primary_product_uom_code',3)->nullable();
            $table->string('firm_planned_flag',1)->nullable();
            $table->datetime('planned_start_date')->nullable();
            $table->datetime('planned_completion_date')->nullable();
            $table->datetime('actual_start_date')->nullable();
            $table->datetime('actual_completion_date')->nullable();
            $table->datetime('released_date')->nullable();
            $table->datetime('closed_date')->nullable();
            $table->datetime('canceled_date')->nullable();
            $table->string('canceled_reason',240)->nullable();
            $table->datetime('need_by_date')->nullable();
            $table->string('status_change_reason',240)->nullable();
            $table->float('completed_quantity')->nullable();
            $table->float('scrapped_quantity')->nullable();
            $table->float('rejected_quantity')->nullable();
            $table->string('overcompl_tolerance_type',30)->nullable();
            $table->float('overcompl_tolerance_value')->nullable();
            $table->string('supply_type',30)->nullable();
            $table->string('compl_subinventory_code',10)->nullable();
            $table->float('compl_locator_id')->nullable();
            $table->string('serial_tracking_flag',1)->nullable();
            $table->string('back_to_back_flag',1)->nullable();
            $table->string('orchestration_code',30)->nullable();
            $table->string('interface_source_code',30)->nullable();
            $table->float('sco_supply_order_id')->nullable();
            $table->string('contract_mfg_flag',1)->nullable();
            $table->float('cm_po_header_id')->nullable();
            $table->float('cm_po_line_id')->nullable();
            $table->float('cm_po_line_loc_id')->nullable();
            $table->string('order_less_flag',1)->nullable();
            $table->string('source_system_type',30)->nullable();
            $table->float('source_system_id')->nullable();
            $table->string('source_header_ref',240)->nullable();
            $table->float('source_header_ref_id')->nullable();
            $table->string('source_line_ref',240)->nullable();
            $table->float('source_line_ref_id')->nullable();
            $table->float('mnt_forecast_id')->nullable();
            $table->string('pjc_context_category',40)->nullable();
            $table->float('pjc_project_id')->nullable();
            $table->string('pjc_project_float',25)->nullable();
            $table->float('pjc_task_id')->nullable();
            $table->string('pjc_task_float',100)->nullable();
            $table->float('pjc_expenditure_type_id')->nullable();
            $table->DATE('pjc_expenditure_item_date')->nullable();
            $table->float('pjc_organization_id')->nullable();
            $table->string('pjc_billable_flag',1)->nullable();
            $table->string('pjc_capitalizable_flag',1)->nullable();
            $table->float('pjc_work_type_id')->nullable();
            $table->float('pjc_contract_id')->nullable();
            $table->float('pjc_contract_line_id')->nullable();
            $table->float('pjc_funding_allocation_id')->nullable();
            $table->string('pjc_reserved_attribute1',150)->nullable();
            $table->string('pjc_reserved_attribute2',150)->nullable();
            $table->string('iot_sync_status',30)->nullable();
            $table->string('preassign_lot_flag',1)->nullable();
            $table->string('resequence_flag',1)->nullable();
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
            $table->float('attribute_float10')->nullable();
            $table->DATE('attribute_date1')->nullable();
            $table->DATE('attribute_date2')->nullable();
            $table->datetime('attribute_datetime1')->nullable();
            $table->datetime('attribute_datetime5')->nullable();
            $table->float('request_id')->nullable();
            $table->string('job_definition_name',100)->nullable();
            $table->string('job_definition_package',140)->nullable();
            $table->datetime('deleted_at')->nullable();
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
        Schema::dropIfExists('wie_work_orders');
    }
}
