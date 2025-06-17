<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quotation extends Model
{
    use SoftDeletes, Notifiable;
    public $table = 'bm_po_header_all';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'id',
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
        'effective_date',
        'revision_number',
        'approved_date',
        'closed_date',
        'cancel_flag',
        'status',
        'term_id',
        'ship_via_code',
        'description',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function QuotationDetail()
    {

        return $this->morphedByMany(QuotationDetail::class, 'line_id');
    }
    public function vendor()
    {
        return $this->hasone(Vendor::class, 'vendor_id', 'vendor_id');
    }
    public function supplierSite()
	{
		 return $this->hasone(Site::class, 'site_code', 'vendor_site_id');
	}
}
