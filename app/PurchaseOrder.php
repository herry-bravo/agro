<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class PurchaseOrder extends Model
{
    use SoftDeletes, Notifiable,LogsActivity;
    public $table = 'bm_po_header_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
        'po_head_id',
        'organization_id',
        'created_by',
        'agent_id',
        'type_lookup_code',
        'vendor_id',
        'vendor_site_id',
        'ship_to_location',
        'bill_to_location',
        'segment1',
        'currency_code',
        'rate_date',
        'rate',
        'notes',
        'freight',
        'carrier',
        'effective_date',
        'revision_number',
        'approved_date',
        'closed_date',
        'cancel_flag',
        'status',
        'term_id',
        'ship_via_code',
        'description',
        'attribute_number1',
        'attribute_number2',
        'source',
        'attribute1',
        'attribute2',
        'attribute3',
        'created_at',
        'updated_at',
        'deleted_at',
        'payment_due_date',
    ];
	public function taxes()
    {
        return $this->hasone(Tax::class, 'tax_rate', 'rate');
    }
	public function vendor()
    {
        return $this->hasone(Vendor::class, 'vendor_id', 'vendor_id');
    }

	public function purchaseOrderDet()
	{
		 return $this->hasmany(PurchaseOrderDet::class, 'po_header_id', 'po_head_id');
	}
	public function site()
	{
		 return $this->hasone(Site::class, 'site_code', 'ship_to_location');
	}
    public function supplierSite()
	{
		 return $this->hasone(Site::class, 'site_code', 'vendor_site_id');
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
  public function terms()
  {
       return $this->hasone(Terms::class, 'id', 'term_id');
  }
  public function origin()
  {
       return $this->hasone(Terms::class, 'term_code', 'attribute3');
  }
  public function comment()
  {
       return $this->hasone(Comments::class, 'app_header_id', 'attribute_number1');
  }
  public function  getActivitylogOptions(): LogOptions
  {
      return LogOptions::defaults()
                      ->logAll();
  }

}
