<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MakeOrBuy extends Model
{
    use SoftDeletes;

    public $table = 'bm_mtl_make_or_buy';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'created_at',
        'make_or_buy_code',
        'make_or_buy',
        'updated_at',
        'deleted_at',
    ];


}
