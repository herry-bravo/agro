<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Shipment extends Model
{
    use SoftDeletes;

    public $table = 'bm_order_lines_all';
    protected $dates = [
        'promise_date',
        'request_date',
        'schedule_ship_date',
        'pricing_date',
        'fulfillment_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'header_id',
        'line_id',
        'line_number',
        'split_line_id',
        'inventory_item_id',
        'user_description_item ',
        'unit_list_price',
        'unit_selling_price',
        'order_quantity_uom',
        'pricing_quantity',
        'shipped_quantity',
        'ordered_quantity',
        'fulfilled_quantity',
        'shipping_quantity',
        'shipping_quantity_uom',
        'cancelled_quantity',
        'price_list_id',
        'pricing_context',
        'pricing_attribute1',
        'item_identifier_type',
        'shipping_interfaced_flag',
        'split_from_line_id',
        'ship_set_id',
        'split_by',
        'unit_selling_percent',
        'unit_percent_base_price',
        'invoice_interface_status_code',
        'invoiced_quantity',
        'tax_code',
        'flow_status_code',
        'conversion_type',
        'conversion_date',
        'conversion_rate',


    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'id');
    }


}
