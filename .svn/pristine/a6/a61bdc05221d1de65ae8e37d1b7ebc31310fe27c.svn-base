<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualityManagement extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bm_mtl_qlty_mgm';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		'id',
        'attribute_aju',
        'inventory_item_id',
        'item_type',
        'quantity',
        'attribute_long',
        'attribute_short',
        'attribute_outtrhow',
        'attribute_prohibitive',
        'attribute_moisture',
        'attribute_grade',
        'intattribute1',
        'intattribute2',
        'intattribute3',
        'intattribute4',
        'intattribute5',
        'date_time',
        'attribute_free',
        'attribute_gsm',
        'attribute_thick',
        'attribute_bright',
        'attribute_light',
        'attribute_ash',
        'attribute_bst',
        'attribute_rct',
        'attribute_density',
        'attribute_strength',
        'attribute_hydra',
        'attribute_note',
    ];

	public function rcvheader(){
		return $this->hasone(RcvHeader::class, 'attribute1', 'attribute_aju');
	}

	public function itemmaster(){
		return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id');
	}
}
