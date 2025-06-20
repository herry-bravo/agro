<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public $table = 'bm_category';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'category_code',
        'category_name',
        'description',
        'attribute1',
        'attribute2',
        'inventory_account_code',
        'consumption_account_code',
        'payable_account_code',
        'receivable_account_code',
        'account_type',
        'org_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function projects()
    {
        return $this->hasMany(itemMaster::class);
    }

    public function cogs()
    {
        return $this->hasOne(AccountCode::class, 'account_code','consumption_account_code');
    }


    public function inventory()
    {
        return $this->hasOne(AccountCode::class, 'account_code','inventory_account_code');
    }

    public function acc()
    {
        return $this->hasOne(AccountCode::class, 'account_code','attribute1');
    }

    public function payable()
    {
        return $this->hasOne(AccountCode::class, 'account_code','payable_account_code');
    }

    public function accReceivable()
    {
        return $this->hasOne(AccountCode::class, 'account_code','receivable_account_code');
    }

    public function arTax()
    {
        return $this->hasOne(AccountCode::class, 'account_code','receivable_account_code');
    }
    public function cash()
    {
        return $this->hasOne(AccountCode::class, 'account_code','attribute2');
    }
    public function acccash()
    {
        return $this->hasOne(AccountCode::class, 'account_code','attribute2');
    }
}
