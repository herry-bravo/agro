<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterialTxns extends Model
{
	use SoftDeletes;
    public $table = 'bm_inv_material_txns';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'transaction_date',
    ];

    protected $fillable = [
		'id',
		'transaction_id',
		'last_updated_by',
		'created_by',
		'last_update_login',
		'inventory_item_id',
		'organization_id',
		'subinventory_code',
		'transaction_type_id',
		'transaction_action_id',
		'transaction_source_type_id',
		'transaction_source_id',
		'transaction_source_name',
		'transaction_quantity',
		'transaction_uom',
		'primary_quantity',
		'transaction_date',
		'variance_amount',
		'acct_period_id',
		'transaction_reference',
		'distribution_account_id',
		'actual_cost',
		'transaction_cost',
		'new_cost',
		'currency_code',
		'currency_conversion_rate',
		'currency_conversion_type',
		'currency_conversion_date',
		'department_id',
		'master_schedule_update_code',
		'receiving_document',
		'picking_line_id',
		'trx_source_line_id',
		'trx_source_delivery_id',
		'physical_adjustment_id',
		'cycle_count_id',
		'rma_line_id',
		'transfer_transaction_id',
		'transaction_set_id',
		'rcv_transaction_id',
		'move_transaction_id',
		'completion_transaction_id',
		'source_code',
		'source_line_id',
		'vendor_lot_number',
		'transfer_organization_id',
		'transfer_subinventory',
		'shipment_number',
		'transfer_cost',
		'transportation_cost',
		'waybill_airbill',
		'freight_code',
		'number_of_containers',
		'attribute_category',
		'attribute1',
		'department_code',
		'transaction_group_id',
		'final_completion_flag',
		'shipment_costed',
		'material_account',
		'material_overhead_account',
		'resource_account',
		'outside_processing_account',
		'overhead_account',
		'transfer_cost_group_id',
		'overcompletion_transaction_qty',
		'overcompletion_primary_qty',
		'overcompletion_transaction_id',
		'pick_slip_number',
		'pick_slip_date',
		'cost_category_id',
		'secondary_uom_code',
		'secondary_transaction_quantity',
		'ship_to_location_id',
		'intransit_account',
		'fob_point',
		'parent_transaction_id',
		'trx_flow_header_id',
		'original_transaction_temp_id',
		'transfer_price',
		'expense_account_id',
		'cogs_recognition_percent',
		'so_issue_account_type',
		'pick_slip_line_number',
		'orig_transaction_quantity',
		'orig_subinventory_code',
		'location_type',
		'attribute16',
		'attribute_number1',
		'attribute_datetime1',
		'consumption_line_id',
		'tax_invoice_number',
		'tax_invoice_date',
		'product_category',
		'product_type',
		'ship_from_location_id',
		'category_id',
		'wip_supply_type',
		'country_of_origin_code',
        'stg',
		'created_at',
		'updated_at',
		'deleted_at',
    ];

	public function user()
	{
		 return $this->hasone(User::class, 'id', 'agent_id');
	}
	public function itemmaster()
	{
		return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id');
	}
	public function materialtransaction()
	{
		return $this->hasone(MaterialTransaction::class,'trx_code','transaction_type_id');
	}
    	public function subinventory()
	{
		return $this->hasone(Subinventories::class,'sub_inventory_name','subinventory_code');
	}
    public function tfsubinventory()
	{
		return $this->hasone(Subinventories::class,'sub_inventory_name','transfer_subinventory');
	}
}
