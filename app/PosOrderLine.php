<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PosOrderLine extends Model
{
    public $table = 'bm_pos_order_lines';

    protected $fillable = [
        'pos_order_id',
        'inventory_item_id',
        'item_code',
        'item_description',
        'quantity',
        'uom',
        'unit_price',
        'discount',
        'tax_rate',
        'subtotal',
        'total_line',
        'created_by',
    ];

    public function order()
    {
        return $this->belongsTo(PosOrder::class, 'pos_order_id', 'id');
    }

    public function item()
    {
        return $this->hasOne(ItemMaster::class, 'inventory_item_id', 'inventory_item_id');
    }
}
