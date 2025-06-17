<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subinventories extends Model
{
	 use SoftDeletes, Notifiable;
    public $table = 'bm_mtl_item_sub_inventories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'sub_inventory_name',
		'description',
		'locator_type',
		'attribute_category',
		'sub_inventory_group',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}