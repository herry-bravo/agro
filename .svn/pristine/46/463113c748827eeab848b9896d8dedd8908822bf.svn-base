<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shipment_header extends Model
{
    use SoftDeletes;

    public $table = 'bm_wsh_delivery_details';
    protected $dates = [
        'date_requested',
        'date_scheduled',
        'conversion_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'delivery_detail_id',
        'project_expense_flag',
        'source_header_id',
        'source_line_id',
        'source_header_number',
        'cust_po_number ',
        'sold_to_contact_id',
        'inventory_item_id',
        'item_description',
        'ship_from_location_id',
        'organization_id',
        'ship_to_location_id',
        'src_requested_quantity',
        'src_requested_quantity_uom',
        'cancelled_quantity',
        'requested_quantity',
        'requested_quantity_uom',
        'shipped_quantity',
        'delivered_quantity',
        'cycle_count_quantity',
        'cycle_count_quantity',
        'move_order_line_id',
        'subinventory',
        'revision',
        'lot_number',
        'released_status',
        'serial_number',
        'customer_item_id',
        'net_weight',
        'weight_uom_code',
        'volume',
        'org_id',
        'attribute1',
        'attribute2',
        'created_by',
        'gross_weight',
        'unit_price',
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


    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'id');
    }

}
