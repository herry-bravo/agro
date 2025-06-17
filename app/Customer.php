<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use SoftDeletes, LogsActivity;

    public $table = 'bm_cust_site_uses_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'cust_party_code',
        'purpose_date',
        'party_name',
        'address1',
        'address2',
        'address3',
        'city',
        'province',
        'country',
        'postal_code',
        'phone',
        'email',
        'sales_tax_code',
        'currency_code',
        'status',
        'org_id',
        'mobile',
        'customer_type',
        'pic',
        'title',
        'attribute1',
        'attribute2',
        'attribute3',
        'attribute4',
        'attribute5',
        'attribute6',
        'attribute7',
        'created_at',
        'updated_at'

    ];

    public function currency()
    {
        return $this->hasOne(CurrencyGlobal::class, 'id', 'currency_code');
    }

    public function tax2()
    {
        return $this->hasOne(Tax::class, 'tax_code', 'sales_tax_code');
    }
    public function  getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                        ->logAll();
    }
}
