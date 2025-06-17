<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrxStatuses extends Model
{
	 use SoftDeletes, Notifiable;
    public $table = 'bm_trx_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'trx_code',
		'trx_name',
		'trx_function',
		'updated_by',
		'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
