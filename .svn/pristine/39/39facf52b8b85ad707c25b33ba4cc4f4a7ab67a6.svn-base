<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryDistrib extends Model
{
    use SoftDeletes;

    public $table = 'bm_wsh_delivery_distb_items';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'header_id',
        'line_id',
        'container_item_id',
        'load_item_id',
        'max_load_quantity',
        'attribute_category',
        'attribute1',
        'attribute2',
        'attribute3',
        'job_definition_name',
        'master_organization_id',
        'job_definition_package',
        'preferred_flag',
        'object_version_number',
        'container_load_code',
        'attribute_number1',
        'attribute_number2',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    public function deliveryDetail(){
        return $this->hasOne(DeliveryDetail::class,'id','line_id');
    }

    public function devDetail(){
        return $this->belongsTo(DeliveryDetail::class, 'line_id', 'id');
    }

    public function deliveryHeader(){
        return $this->hasOne(DeliveryHeader::class,'delivery_id','header_id');
    }

    public function ItemMaster ()
    {
        return $this->hasOne(ItemMaster::class,'inventory_item_id','load_item_id');
    }

}
