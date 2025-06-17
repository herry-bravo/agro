<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MissExpenses extends Model
{
	use SoftDeletes;
    use HasFactory;

    public $table = 'bm_miss_expenses_id';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		'id',
		'order_number',
		'po_line_id',
        'po_line_location_id',
		'inventory_item_id',
		'shipment_unit_price',
		'item_description',
		'attributenumber',
		'intattribute1',
		'intattribute2',
		'intattribute3',
		'intattribute4',
		'intattribute5',
		'intattribute6',
		'intattribute7',
		'intattribute8',
		'intattribute9',
		'intattribute10',
		'intattribute11',
		'intattribute12',
		'intattribute13',
		'intattribute14',
		'intattribute15',
		'intattribute16',
		'intattribute17',
		'intattribute18',
		'intattribute19',
		'rcv_price',
		'created_at',
		'updated_at',
		'deleted_at',
    ];


	public function itemmaster()
	{
		return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id');
	}


	public function purchaseorderdet()
	{
		 return $this->hasone(PurchaseOrderDet::class, 'id', 'po_line_location_id');
	}
}
