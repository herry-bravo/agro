<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class DeliveryDetail extends Model
{
    use SoftDeletes;
    public function getroutekeyname(){
        return 'delivery_detail_id';
    }
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
        'id',
        'delivery_detail_id',
        'project_expense_flag',
        'source_header_id',
        'source_line_id',
        'source_header_number',
        'delivery_name',
        'cust_po_number',
        'sold_to_contact_id',
        'inventory_item_id',
        'item_description',
        'ship_from_location_id',
        'org_id',
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
        'conversion_date',
        'conversion_rate',
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
    public function sales(){
        return $this->hasOne(SalesOrder::class,'order_number','source_header_number');
    }
    public function sub_inventory(){
        return $this->hasOne(Subinventories::class,'sub_inventory_name','subinventory');
    }
    public function distribLine()
    {
        return $this->hasmany(DeliveryDistrib::class,'line_id','id');
    }

    public function delivery()
    {
        return $this->hasOne(DeliveryHeader::class,'delivery_id','delivery_detail_id');
    }

    public function rollCount()
    {
        return $this->distribLine()->count('load_item_id');
    }
    public function rollSum()
    {
        return $this->distribLine()->sum('attribute_number1');
    }

}
