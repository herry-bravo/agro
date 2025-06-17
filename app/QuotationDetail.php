<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuotationDetail extends Model
{
    use SoftDeletes, Notifiable;
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
        'inventory_item_id',
        'item_description',
        'po_uom_code',
        'unit_price',
        'po_quantity',
        'start_date',
        'end_date',
        'attribute1',
        'attribute2',
        'attribute3',
        'taxable_flag',
        'tax_name',
        'quantity_receive',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    public function itemMaster()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id')->select('inventory_item_id','description','item_code');
    }
    public function quotation()
    {
        return $this->hasone(Quotation::class, 'id', 'po_header_id');
    }

}
