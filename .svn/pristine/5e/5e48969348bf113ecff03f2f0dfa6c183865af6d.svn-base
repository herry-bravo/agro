<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CurrencyRate extends Model
{
    use SoftDeletes;

    public $table = 'bm_currency_rate_id';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'rate_date',
        'rate',
        'currency_id',
        'org_id',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];


}
