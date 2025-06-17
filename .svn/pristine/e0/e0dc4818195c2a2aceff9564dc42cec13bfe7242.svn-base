<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AtpReply extends Model
{
    use SoftDeletes;

    public $table = 'bm_atp_reply_id';
    protected $dates = [
				'created_at',
				'updated_at',
				'deleted_at',
				'etd_atp',
				'eta_atp',

    ];

    protected $fillable = [
			    'id',
				'po_header_id',
				'order_number',
				'po_line_id',
				'inventory_item_id',
				'item_description',
				'atp_qty',
				'atp_price',
				'etd_atp',
				'eta_atp',
				'reference',
				'attribute1',
				'intattribute1',
				'created_at',
				'updated_at',
				'deleted_at',
    ];

	public function itemMaster()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id')->select('inventory_item_id','description','item_code');
    }

}
