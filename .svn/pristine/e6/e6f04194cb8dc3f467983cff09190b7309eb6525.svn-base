<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Onhand extends Model
{
    use SoftDeletes, Notifiable;
    public $table = 'bm_inv_onhand_quantities_detail';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'inventory_item_id',
		'standard_pack_uom',
		'standard_pack_quantity',
		'organization_id',
		'date_received',
		'last_update_date',
		'last_updated_by',
		'creation_date',
		'created_by',
		'last_update_login',
		'primary_transaction_quantity',
		'subinventory_code',
		'revision',
		'locator_id',
		'create_transaction_id',
		'update_transaction_id',
		'lot_number',
		'orig_date_received',
		'onhand_quantities_id',
		'transaction_uom_code',
		'transaction_quantity',
		'secondary_uom_code',
		'secondary_transaction_quantity',
		'orig_source_txn_id',
		'owning_type',
		'owning_entity_id',
		'aging_onset_date',
		'aging_expiration_date',
		'inv_striping_category',
		'project_id',
		'task_id',
		'country_of_origin_code',
		'inv_reserved_attribute1',
		'created_at',
		'updated_at',
		'deleted_at',
    ];

	public function user()
	{
		 return $this->hasone(User::class, 'id', 'agent_id');
	}
	  public function trxStatuses()
    {
		return $this->hasone(TrxStatuses::class, 'trx_code', 'status');
    }
	public function itemmaster()
	{
		return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id');
	}
	public function subinventories()
	{
		return $this->hasone(Subinventories::class, 'sub_inventory_name', 'subinventory_code');
	}

}
