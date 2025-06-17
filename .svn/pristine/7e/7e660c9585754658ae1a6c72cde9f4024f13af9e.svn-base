<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanningDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bm_planning_detail_id';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'header_id',
        'line_id',
        'line_number',
        'inventory_item_id',
        'item_description',
        'attribute_gsm_line',
        'attribute_w_line',
        'total_roll_by_line',
        'qty_estimation',
        'total_qty',
        'status',
        'operation_unit',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
