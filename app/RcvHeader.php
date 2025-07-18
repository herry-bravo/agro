<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class RcvHeader extends Model
{
    use SoftDeletes, Notifiable;
    public $table = 'bm_c_rcv_shipment_header_id';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'gl_date',
    ];

    protected $fillable = [
        'id',
        'shipment_header_id',
		'last_updated_by',
		'created_by',
		'last_update_login',
		'receipt_source_code',
		'vendor_id',
		'vendor_site_id',
		'organization_id',
		'shipment_num',
		'receipt_num',
		'ship_to_location_id',
		'bill_of_lading',
		'packing_slip',
		'shipped_date',
		'freight_carrier_id',
		'employee_id',
		'num_of_containers',
		'waybill_airbill_num',
		'comments',
		'transaction_type',
		'attribute1',
		'attribute2',
		'attribute_integer1',
		'attribute_date1',
		'attribute_datetime1',
		'request_id',
		'asn_type',
		'edi_control_num',
		'notice_creation_date',
		'gross_weight',
		'gross_weight_uom_code',
		'net_weight',
		'net_weight_uom_code',
		'freight_terms',
		'freight_bill_integer',
		'invoice_num',
		'invoice_date',
		'invoice_amount',
		'tax_name',
		'tax_amount',
		'freight_amount',
		'invoice_status_code',
		'asn_status',
		'currency_code',
		'conversion_rate_type',
		'conversion_rate',
		'conversion_date',
		'payment_terms_id',
		'ship_to_org_id',
		'customer_id',
		'customer_site_id',
		'remit_to_site_id',
		'ship_from_location_id',
		'approval_status',
		'gl_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
	public function taxes()
    {
        return $this->hasone(Tax::class, 'tax_rate', 'conversion_rate');
    }
	public function vendor()
    {
        return $this->hasone(Vendor::class, 'vendor_id', 'vendor_id');
    }
	public function warehouse()
    {
        return $this->hasone(Subinventories::class, 'sub_inventory_name', 'ship_to_location_id');
    }

	public function purchaseOrderDet()
	{
		 return $this->hasmany(PurchaseOrderDet::class, 'id', 'header_id');
	}
	public function site()
	{
		 return $this->hasone(Site::class, 'site_code', 'ship_to_location');
	}
    public function vendor_site()
	{
		 return $this->hasone(Site::class, 'site_code', 'vendor_site_id');
	}   
	public function poagent()
	{
		 return $this->hasone(PoAgent::class, 'agent_id', 'agent_id');
	}
	public function user()
	{
		 return $this->hasone(User::class, 'id', 'created_by');
	}
	  public function trxStatuses()
    {
		return $this->hasone(TrxStatuses::class, 'trx_code', 'status');
    }
	public function grandtotal() {
		return $this->PurchaseOrderDet()->sum(DB::raw('po_quantity * unit_price'));
  }
  public function rcvDetail()
    {
		return $this->hasone(RcvDetail::class, 'shipment_header_id', 'shipment_header_id');
    }
}
