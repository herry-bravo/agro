<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Terms extends Model
{
	 use SoftDeletes;
    public $table = 'bm_global_terms_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'term_category',
		'term_code',
		'terms_name',
        'attribute1',
		'updated_by',
		'created_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
