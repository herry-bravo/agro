<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesOrderDeliveries extends Model
{
    use SoftDeletes;

    public $table = 'bm_order_headers_all';
    protected $dates = [
        'expiration_date',
        'ordered_date',
        'request_date',
        'pricing_date',
        'created_at',
        'updated_at',
        'deleted_at',

    ];

    protected $fillable = [
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
        'customer_payment_term_id',
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class,'id');
    }

}
