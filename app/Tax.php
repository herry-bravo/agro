<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use SoftDeletes;

    public $table = 'bm_taxs_id_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'tax_code',
        'tax_regimes_b',
        'tax_name',
        'tax_rate',
        'tax_taxes_tl',
        'type_tax_use',
        'tax_account',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    public function acc()
    {
        return $this->hasOne(AccountCode::class, 'account_code','tax_account');
    }
}
