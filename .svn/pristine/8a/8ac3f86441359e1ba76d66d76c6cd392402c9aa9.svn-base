<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryHeader extends Model
{
    use SoftDeletes;

    public $table = 'bm_wsh_new_deliveries';

    protected $dates = [
        'actual_ship_date',
        'created_at',
        'updated_at',
        'deleted_at',
        'on_or_about_date',
    ];

    protected $fillable = [
        'id',
        'delivery_id',
        'delivery_name',
        'planned_flag',
        'status_code',
        'freight_terms_code',
        'fob_code',
        'acceptance_flag',
        'accepted_by',
        'confirmed_by',
        'description',
        'gross_weight',
        'net_weight',
        'weight_uom_code',
        'volume',
        'bill_freight_to',
        'carried_by',
        'attribute_category',
        'attribute1',
        'attribute2',
        'created_by',
        'last_updated_by',
        'last_update_login',
        'ship_method_code',
        'dock_code',
        'delivery_type',
        'currency_code',
        'organization_id',
        'ship_to_party_id',
        'sold_to_party_id',
        'packing_slip_number',
        '[level]',
        'lvl',
        'on_or_about_date',
        'confirm_date',
        'actual_ship_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'id');
    }

    public function trxstatus() {
        return $this->hasOne(TrxStatuses::class,'trx_code','lvl');
    }
    public function statusCode() {
        return $this->hasOne(TrxStatuses::class,'trx_code','status_code');
    }

    public function detail() {
        return $this->hasOne(DeliveryDetail::class,'delivery_detail_id','delivery_id');
    }

    public function customer(){
        return $this->hasOne(Customer::class,'cust_party_code','sold_to_party_id');
    }

    public function party_site(){
        return $this->hasOne(Site::class,'site_code','ship_to_party_id');
    }

    public function currency()
    {
        return $this->hasOne(CurrencyGlobal::class, 'currency_code', 'currency_code');
    }

    public function term()
    {
        return $this->hasOne(Terms::class, 'id', 'freight_terms_code');
    }
    public function site()
    {
        return $this->hasOne(Site::class, 'site_code', 'ship_to_party_id');
    }
}
