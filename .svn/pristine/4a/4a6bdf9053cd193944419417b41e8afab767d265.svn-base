<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class CustomerTrx extends Model
{
    use SoftDeletes;

    public $table = 'bm_ra_customer_trx_all';
    protected $dates = [
        'date_requested',
        'date_scheduled',
        'conversion_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'customer_trx_id',
        'src_invoicing_rule_id',
        'bill_template_name',
        'requires_manual_scheduling',
        'intercompany_flag',
        'last_update_date',
        'last_updated_by',
        'created_by',
        'last_update_login',
        'trx_number',
        'trx_date',
        'set_of_books_id',
        'bill_to_contact_id',
        'batch_id',
        'reason_code',
        'sold_to_customer_id',
        'sold_to_contact_id',
        'sold_to_site_use_id',
        'bill_to_customer_id',
        'bill_to_site_use_id',
        'ship_to_customer_id',
        'ship_to_contact_id',
        'ship_to_site_use_id',
        'shipment_id',
        'remit_to_address_id',
        'term_id',
        'term_due_date',
        'previous_customer_trx_id',
        'printing_original_date',
        'printing_last_printed',
        'printing_option',
        'printing_count',
        'printing_pending',
        'purchase_order',
        'purchase_order_revision',
        'purchase_order_date',
        'customer_reference',
        'customer_reference_date',
        'currency_code',
        'ship_to_site_use_id',
        'picked_quantity',
        'unit_weight',
        'unit_volume',
        'ship_to_party_id',
        'sold_to_party_id',
        'bill_to_party_id',
        'bill_to_location_id',
        'bill_to_contact_id',
        'ship_set_name',
        'source_shipment_id',
        'source_shipment_number',
        'sales_order_number',
        'conversion_type',
        'spq_uom',
        'rcv_shipment_line_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'intattribute1',
        'intattribute2',
        'intattribute3'
    ];

    public function ItemMaster ()
    {
        return $this->hasOne(ItemMaster::class,'inventory_item_id','inventory_item_id');
    }
}
