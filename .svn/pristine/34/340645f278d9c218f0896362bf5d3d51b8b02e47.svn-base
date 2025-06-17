<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PurchaseOrderDet extends Model
{
    use SoftDeletes, Notifiable,LogsActivity;
    public $table = 'bm_po_lines_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'line_id',
        'po_header_id',
        'organization_id',
        'line_type_id',
        'created_by_id',
        'line_number',
        'source_line_id',
        'inventory_item_id',
        'item_description',
        'po_uom_code',
        'unit_price',
        'base_model_price',
        'po_quantity',
        'start_date',
        'end_date',
        'attribute1',
        'attribute2',
        'attribute3',
        'line_status',
        'base_uom',
        'base_qty',
        'taxable_flag',
        'tax_name',
        'quantity_receive',
        'need_by_date',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    public function itemMaster()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id')->select('inventory_item_id','item_code','description');
    }
    public function quotation()
    {
        return $this->hasone(Quotation::class, 'id', 'po_header_id');
    }
    public function purchaseorder()
    {
        return $this->hasone(PurchaseOrder::class, 'po_head_id', 'po_header_id');
    }
    public function  getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                        ->logAll();
    }

    public function tax()
    {
        return $this->hasone(Tax::class,'tax_code','tax_name');
    }

}
