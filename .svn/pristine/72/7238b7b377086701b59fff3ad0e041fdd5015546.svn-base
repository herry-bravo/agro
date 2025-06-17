<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class CcBook extends Model
{
	 use SoftDeletes, Notifiable;
    public $table = 'bm_cc_book_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'cost_center',
		'cc_name',
		'cc_status',
		'cc_status',
		'updated_by',
		'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}