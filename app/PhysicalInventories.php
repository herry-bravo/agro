<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhysicalInventories extends Model
{
	 use SoftDeletes, Notifiable;
    public $table = 'bm_inv_physical_inventories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    protected $fillable = [
	    'id',
		'tag_id',
		'owning_type',
		'owning_entity_id',
		'physical_inventory_id',
		'organization_id',
		'last_updated_by',
		'created_by',
		'tag_integer',
		'adjustment_id',
		'inventory_item_id',
		'tag_quantity',
		'tag_uom',
		'tag_quantity_at_standard_uom',
		'standard_uom',
		'subinventory',
		'locator_id',
		'lot_integer',
		'lot_expiration_date',
		'revision',
		'serial_num',
		'counted_by_employee_id',
		'lot_serial_controls',
		'attribute_category',
		'attribute1',
		'attribute2',
		'request_id',
		'tag_secondary_quantity',
		'tag_secondary_uom',
		'tag_qty_at_std_secondary_uom',
		'standard_secondary_uom',
		'attribute16',
		'attribute_integer1',
		'attribute_integer2',
		'attribute_date1',
		'created_at',
		'updated_at',
		'deleted_at',
    ];

    public function itemMaster()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id');
    }

    public function subInventories()
    {
        return $this->hasone(Subinventories::class, 'sub_inventory_name', 'subinventory');
    }
}
