<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class HPCount extends Model
{
	 use SoftDeletes, Notifiable;
    public $table = 'bm_HPO_counter';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'updated_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}