<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OnhandFinishGood extends Model
{
    use HasFactory;

    use SoftDeletes;

    public $table = 'bm_inv_onhand_fg_detail';

    protected $dates = [
        'completion_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'id',
        'inventory_item_id',
        'uniq_attribute_roll',
        'attribute_number_gsm',
        'attribute_number_l',
        'attribute_number_w',
        'primary_uom',
        'primary_quantity',
        'secondary_quantity',
        'attribute_num_quality',
        'shipping_status_flag',
        'wip_status_flag',
        'reference',
        'completion_date',
        'attribute_roll',
        'attribute_location',
        'attribute_char',
        'attribute_number',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function item()
    {
        return $this->hasone(itemMaster::class, 'inventory_item_id', 'inventory_item_id')->select('inventory_item_id','description','item_code');
    }
}
