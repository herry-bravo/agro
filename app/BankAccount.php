<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankAccount extends Model
{
    use SoftDeletes;

    public $table = 'bm_bank_acct_uses_all';

    protected $fillable = [
        'id',
        'bank_acct_use_id',
        'bank_account_id',
        'primary_flag',
        'attribute_category',
        'attribute1',
        'attribute2',
        'request_id',
        'org_party_id',
        'ap_use_enable_flag',
        'ar_use_enable_flag',
        'xtr_use_enable_flag',
        'pay_use_enable_flag',
        'end_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    public function acccode ()
    {
        return $this->hasOne(AccountCode::class,'bank_acct_use_id','account_code');
    }
    public function customer ()
    {
        return $this->hasOne(Customer::class,'org_party_id','cust_party_code');
    }
}
