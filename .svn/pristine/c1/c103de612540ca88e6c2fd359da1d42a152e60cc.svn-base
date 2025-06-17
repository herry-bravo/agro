<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;

    public $table = 'bm_currencies_id_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'currency_code',
        'currency_name',
        'currency_status',
        'created_by',
        'updated_by',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'currency_id', 'id');
    }
    public function rate()
    {
        return $this->hasMany(CurrencyRate::class, 'currency_id', 'currency_code');
    }
}
