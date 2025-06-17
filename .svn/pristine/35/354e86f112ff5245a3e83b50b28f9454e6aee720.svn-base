<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class RequisitionDetail extends Model
{
    use SoftDeletes;
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
		'vendor_id',
		'quantity',
		'quantity_processed',
		'estimated_cost',
		'requested_date',
		'purchase_status',
		'org_id',
		'img_path',
		'created_at',
		'updated_at',
		'deleted_at',
    ];
	public function PurchaseRequisition()
    {
        return $this->hasone(PurchaseRequisition::class,'id','header_id');
    }
	    public function itemMaster()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id')->select('inventory_item_id','description','item_code','category_code');
    }
	  public function trxStatuses()
    {
		return $this->hasone(TrxStatuses::class, 'trx_code', 'purchase_status');
    }
}
