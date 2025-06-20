<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ApPayment extends Model
{
    use SoftDeletes,Notifiable;

    public $table='bm_ap_invoice_payments_id';

    protected $dates=[
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable=[
        'id',
        'invoice_id',
        'accounting_date',
        'amount',
        'invoice_payment_id',
        'last_updated_by',
        'last_update_date',
        'payment_num',
        'period_name',
        'posted_flag',
        'set_of_books_id',
        'accts_pay_code_combination_id',
        'asset_code_combination_id',
        'created_by',
        'last_update_login',
        'bank_account_num',
        'bank_account_type',
        'bank_num',
        'discount_lost',
        'invoice_base_amount',
        'payment_base_amount',
        'attribute1',
        'payment_type',
        'attribute_category',
        'invoice_payment_type',
        'global_attribute_category',
        'global_attribute1',
        'accounting_event_id',
        'invoicing_party_id',
        'invoicing_party_site_id',
        'invoicing_vendor_site_id',
        'exchange_rate',
        'exchange_date',
        'invoice_currency_code',
        'payment_currency_code',
        'amount_inv_curr',
        'discount_lost_inv_curr',
        'remit_to_supplier_name',
        'remit_to_supplier_id',
        'remit_to_address_name',
        'remit_to_address_id',
        'global_attribute_date1',
        'org_id'
    ];
    public function vendor() {
        return $this->hasOne(Vendor::class,'vendor_id','invoicing_vendor_site_id');
    }
    public function cust() {
        return $this->hasOne(Customer::class,'cust_party_code','invoicing_vendor_site_id');
    }
    public function bankacc() {
        return $this->hasOne(BankAccount::class,'bank_account_id','bank_num');
    }
    public function accpay() {
        return $this->hasOne(AccPayHeader::class,'invoice_id','invoice_id');
    }
    public function journal() {
        return $this->hasOne(Category::class,'category_code','attribute_category');
    }
    public function saleorder() {
        return $this->hasOne(SalesOrder::class,'id','invoice_id');
    }

}
