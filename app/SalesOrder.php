<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SalesOrder extends Model
{
    use SoftDeletes;

    public $table = 'bm_order_headers_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'ordered_date',
        'tax_date',
        'inv_date',
    ];

    protected $fillable = [
        'id',
        'header_id',
        'org_id',
        'order_type_id',
        'order_number',
        'version_number',
        'order_source_id',
        'source_document_type_id',
        'orig_sys_document_ref',
        'source_document_id',
        'user_item_description',
        'shipment_priority_code',
        'demand_class_code',
        'price_list_id',
        'attribute1',
        'attribute2',
        'attribute3',
        'tax_exempt_flag',
        'tax_exempt_number',
        'tax_exempt_reason_code',
        'conversion_rate',
        'conversion_type_code',
        'conversion_rate_date',
        'partial_shipments_allowed',
        'freight_terms_code',
        'cust_po_number',
        'sold_from_org_id',
        'sold_to_org_id',
        'ship_from_org_id',
        'ship_to_org_id',
        'invoice_to_org_id',
        'created_by',
        'updated_by',
        'cancelled_flag',
        'open_flag',
        'booked_flag',
        'ordered_date',
        'deliver_to_org_id',
        'customer_payment_term_id',
        'inv_number',
        'faktur',
        'total_payment',
        'total_payment_untax',
        'payment_due_date',
        'paid_off',
    ];

    public function sales_detail()
    {
        return $this->hasMany(SalesOrderDetail::class,'id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class,'id');
    }

    public function price_list()
    {
        return $this->hasOne('App\PriceList','id','price_list_id');
    }

    public function customer()
    {
        return $this->hasOne(Customer::class,'cust_party_code','invoice_to_org_id');
    }

    public function party_site(){
        return $this->hasOne(Site::class,'site_code','deliver_to_org_id');
    }

    public function currency()
    {
        return $this->hasOne(CurrencyGlobal::class, 'currency_code', 'attribute1');
    }

    public function trx_code()
    {
        return $this->hasOne(TrxStatuses::class,'trx_code','open_flag');
    }

    public function term()
    {
        return $this->hasOne(Terms::class, 'id', 'attribute3');
    }
    public function terms()
    {
        return $this->belongsTo(Term::class, 'id'); // sesuaikan nama kolom dan model
    }

}
