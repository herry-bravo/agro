<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseRequisitionDet extends Model
{
    use SoftDeletes, Notifiable;
    public $table = 'bm_req_det_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'header_id',
		'line_id',
		'split_line_id',
		'created_by',
		'updated_by',
		'inventory_item_id',
		'pr_uom_code',
		'attribute1',
		'attribute2',
		'line_status',
		'vendor_id',
		'quantity',
		'quantity_processed',
		'estimated_cost',
		'requested_date',
		'purchase_status',
		'org_id',
		'created_at',
		'updated_at',
		'deleted_at'
    ];

    public function itemMaster()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id')->select('inventory_item_id','description','item_code');
    }

    public function pr_header()
    {
        return $this->hasone(PurchaseRequisition::class, 'req_header_id', 'header_id');
    }
}
