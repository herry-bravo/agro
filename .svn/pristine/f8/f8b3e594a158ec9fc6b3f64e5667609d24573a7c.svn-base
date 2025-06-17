<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class InvOnhandFgOstd extends Model
{
    use HasFactory;
    use SoftDeletes, Notifiable;
    public $table = 'bm_inv_onhand_fg_ostd';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'fg_ostd_is',
        'compl_reference',
        'work_order_id',
        'work_order_num',
        'sales_reference',
        'sales_reference_num',
        'customer_code',
        'customer_po_number',
        'inventory_item_id',
        'item_code',
        'attribute_number_gsm',
        'attribute_number_w',
        'attribute_number_l',
        'ordered_quantity',
        'attribute_quality',
        'attribute_int1',
        'attribute_int2',
        'attribute_int3',
        'attribute_char1',
        'attribute_char2',
        'planning_schedule',
        'completed_schedule',
        'status',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
