<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PriceList extends Model
{
    use SoftDeletes, LogsActivity;

    public $table = 'bm_dc_price_list';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'price_list_name',
        'description',
        'effective_date',
        'currency',
        'location_id',
        'created_by',
        'updated_by',
        'flag_status',
    ];

    public function price_detail()
    {
        return $this->morphedByMany(PriceListDetail::class, 'header_id');
    }

    public function  getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
                        ->logAll();
    }

    public function curr(){
        return $this->hasOne(CurrencyGlobal::class, 'id', 'currency');
    }
    public function customer(){
        return $this->hasOne(Customer::class, 'cust_party_code', 'price_list_name');
    }
}
