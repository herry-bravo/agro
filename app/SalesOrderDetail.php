<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesOrderDetail extends Model
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
        'user_description_item',
        'unit_list_price',
        'unit_selling_price',
        'shipping_inventory',
        'packing_style',
        'order_quantity_uom',
        'pricing_quantity',
        'shipped_quantity',
        'ordered_quantity',
        'fulfilled_quantity',
        'shipping_quantity',
        'schedule_ship_date',
        'attribute_number_gsm',
        'attribute_number_w',
        'attribute_number_l',
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
        'disc',
        'org_id',

    ];
    public function transactions()
    {
        return $this->hasMany(Transaction::class,'id');
    }
    public function sales_order()
    {
        return $this->hasMany('App\SalesOrder','id','order_number');
    }

    public function price_list()
    {
        return $this->hasOne(PriceListDetail::class,'id','price_list_id');
    }

    public function price_list_detail()
    {
        return $this->hasOne(PriceListDetail::class,'id','pricing_attribute1');
    }
    public function trx_code()
    {
        return $this->hasOne(TrxStatuses::class,'trx_code','flow_status_code');
    }


    public function salesheader()
    {
        return $this->hasOne(SalesOrder::class,'header_id','header_id');
    }
    public function products()
    {
        return $this->hasOne(ItemMaster::class,'inventory_item_id','inventory_item_id');
    }
    public function itemMaster()
    {
        return $this->hasone(ItemMaster::class, 'inventory_item_id', 'inventory_item_id')->select('inventory_item_id','description','item_code');
    }

    public function tax(){
        return $this->hasOne(Tax::class,'tax_code','tax_code')->where('type_tax_use','Sales');
    }


}
