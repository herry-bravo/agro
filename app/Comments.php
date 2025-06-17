<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
	 use SoftDeletes, Notifiable;
    public $table = 'bm_app_comments';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
       'id',
		'app_header_id',
		'comments',
		'app_lvl_id',
		'userID',
		'created_at',
		'updated_at',
		'deleted_at'
    ];
}