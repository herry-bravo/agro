<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bom extends Model
{
    use SoftDeletes;

    public $table = 'bm_bom_bill_of_mtl_interface';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'effectivity_date',
        'parent_inventory_it',
        'parent_item',
        'parent_item_type',
        'parent_description',
        'substitute_quantity',
        'completion_subinventory',
        'child_inventory_id',
        'item_num',
        'child_item',
        'child_item_type',
        'child_description',
        'uom',
        'supply_subinventory',
        'usage',
        'standard_cost',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
