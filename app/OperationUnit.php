<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class OperationUnit extends Model
{
	use SoftDeletes, Notifiable;
    public $table = 'bm_operation_unit';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'unit_id',
		'short_name',
		'name',
		'capacity',
		'range_capacity_max',
		'range_capacity_min',
		'range_gsm_min',
		'range_gsm_max',
		'machine_status',
		'created_at',
		'updated_at',
		'deleted_at'
    ];
}
