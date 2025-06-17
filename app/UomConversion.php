<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UomConversion extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bm_inv_uom_conversions';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'conversion_id',
        'inventory_item_id',
        'uom_code',
        'contained_uom_code',
        'uom_class',
        'conversion_rate',
        'default_conversion_flag',
        'interior_unit_code',
        'interior_unit_qty',
        'disable_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    public function itemMaster()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id')->select('inventory_item_id','item_code');
    }
}
