<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FgQuality extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bm_inv_attribute_fg';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
		'id',
        'inventory_item_id',
        'uniq_attribute_roll',
        'attribute_number_1',
        'attribute_number_2',
        'attribute_number_3',
        'attribute_number_4',
        'attribute_number_5',
        'attribute_number_6',
        'attribute_number_7',
        'attribute_number_8',
        'attribute_number_9',
        'attribute_number_10',
        'attribute_number_11',
        'attribute_number_12',
        'attribute_number_13',
        'attribute_number_14',
        'attribute_number_15',
        'attribute_number_16',
        'attribute_number_17',
        'attribute_number_18',
        'attribute_number_19',
        'attribute_number_20',
        'attribute_number_21',
        'attribute_number_22',
        'attribute_number_23',
        'attribute_number_24',
        'attribute_number_25',
        'attribute_number_26',
        'roll_status',
        'description',
        'problem',
        'condition',
        'roll_type',
        'attribute_num_quality',
        'attribute_char',
        'reference',
        'transaction_date',
    ];

	public function itemmaster(){
		return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id');
	}
}
