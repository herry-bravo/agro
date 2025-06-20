<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class RcvDetail extends Model
{
    use SoftDeletes, Notifiable;
    public $table = 'bm_c_rcv_transactions_id';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
		'shipment_line_id',
		'created_by',
		'last_update_login',
		'shipment_header_id',
		'line_num',
		'category_id',
		'quantity_shipped',
		'quantity_received',
		'quantity_delivered',
		'quantity_returned',
		'quantity_accepted',
		'quantity_rejected',
		'uom_code',
		'item_description',
		'item_id',
		'item_revision',
		'vendor_item_num',
		'vendor_lot_num',
		'uom_conversion_rate',
		'shipment_line_status_code',
		'source_document_code',
		'po_header_id',
		'po_line_id',
		'po_line_location_id',
		'po_distribution_id',
		'requisition_line_id',
		'req_distribution_id',
		'routing_header_id',
		'packing_slip',
		'from_organization_id',
		'deliver_to_person_id',
		'employee_id',
		'destination_type_code',
		'to_organization_id',
		'to_subinventory',
		'deliver_to_location_id',
		'shipment_unit_price',
		'transfer_cost',
		'transportation_cost',
		'attribute1',
		'attribute2',
		'attribute_integer1',
		'attribute_integer2',
		'attribute_integer3',
		'attribute_date1',
		'attribute_date2',
		'attribute_date3',
		'attribute_date4',
		'attribute_date5',
		'attribute_datetime1',
		'reason_id',
		'government_context',
		'request_id',
		'destination_context',
		'primary_uom_code',
		'tax_name',
		'tax_amount',
		'invoice_status_code',
		'container_num',
		'transfer_percentage',
		'ship_to_location_id',
		'country_of_origin_code',
		'customer_item_num',
		'secondary_quantity_shipped',
		'secondary_quantity_received',
		'secondary_uom_code',
		'amount',
		'amount_received',
		'job_id',
		'requested_amount',
		'material_stored_amount',
		'approval_status',
		'amount_shipped',
		'receipt_advice_header_id',
		'customer_id',
		'customer_site_id',
		'ra_last_action_code',
		'trx_business_category',
		'tax_invoice_integer',
		'tax_invoice_date',
		'tax_classification_code',
		'product_type',
		'product_category',
		'final_discharge_location_id',
		'customer_item_id',
		'eway_bill_integer',
		'eway_bill_date',
		'created_at',
		'updated_at',
		'deleted_at',

    ];
	public function purchaseorderdet()
	{
		 return $this->hasone(PurchaseOrderDet::class, 'id', 'po_line_location_id');
	}
	public function site()
	{
		 return $this->hasone(Site::class, 'site_code', 'ship_to_location');
	}
	public function poagent()
	{
		 return $this->hasone(PoAgent::class, 'agent_id', 'agent_id');
	}
	public function user()
	{
		 return $this->hasone(User::class, 'id', 'agent_id');
	}
	  public function trxStatuses()
    {
		return $this->hasone(TrxStatuses::class, 'trx_code', 'status');
    }
	public function grandtotal() {
		return $this->PurchaseOrderDet()->sum(DB::raw('po_quantity * unit_price'));
    }
	public function rcvheader(){
		return $this->hasone(RcvHeader::class, 'shipment_header_id', 'shipment_header_id');
	}
	public function itemmaster(){
		return $this->hasone(ItemMaster::class, 'inventory_item_id', 'item_id');
	}
	public function purchaseorder(){
		return $this->hasone(PurchaseOrder::class, 'po_head_id', 'po_header_id');
	}
	public function sales(){
		return $this->hasone(SalesOrder::class, 'header_id', 'po_header_id');
	}
    public function sales_detil(){
		return $this->hasone(SalesOrderDetail::class, 'id', 'line_num');
	}
    public function category(){
		return $this->hasone(Category::class, 'category_code', 'category_id');
	}

    public function tax()
    {
        return $this->hasone(Tax::class,'tax_code','tax_name')->where('type_tax_use','=','Purchase');
    }

}
