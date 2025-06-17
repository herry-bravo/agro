<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PriceListDetail extends Model
{
    use SoftDeletes, LogsActivity;

    public $table = 'bm_dc_price_list_lines';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'header_id',
        'line_id',
        'inventory_item_id',
        'user_item_description',
        'uom',
        'unit_price',
        'discount',
        'packing_type',
        'effective_from',
        'effective_to',
        'created_by',
        'updated_by',
    ];

    public function PriceLineList()
    {
        return $this->hasone(PriceList::class, 'id', 'header_id');
    }

    public function item_list()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id')->select('inventory_item_id','description','item_code');
    }

    public function  getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                        ->logAll();
    }

}
