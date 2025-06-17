<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ArCustomerTrxLines extends Model
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'bm_ra_customer_trx_lines_all';
    protected $dates = [
        'last_update_date',
        'creation_date',
        'sales_order_date',
        'program_update_date',
        'wh_update_date',
        'rule_end_date',
        'global_attribute_date1',
        'tax_invoice_date',
        'contract_start_date',
        'contract_end_date',
        'billing_period_start_date',
        'billing_period_end_date',
        'created_at',
        'updated_at',
        // 'deleted_at',
    ];

    protected $fillable = [
        'id',
        'customer_trx_line_id',
        'last_updated_by',
        'created_by',
        'last_update_login',
        'customer_trx_id',
        'line_number',
        'set_of_books_id',
        'code_combinations',
        'reason_code',
        'inventory_item_id',
        'description',
        'previous_customer_trx_id',
        'previous_customer_trx_line_id',
        'quantity_ordered',
        'quantity_credited',
        'quantity_invoiced',
        'unit_selling_price',
        'sales_order',
        'sales_order_revision',
        'sales_order_line',
        'accounting_rule_duration',
        'accounting_rule_id',
        'line_type',
        'attribute_category',
        'attribute1',
        'request_id',
        'program_application_id',
        'program_id',
        'interface_line_context',
        'initial_customer_trx_line_id',
        'interface_line_attribute1',
        'interface_line_attribute2',
        'sales_order_source',
        'taxable_flag',
        'extended_amount',
        'revenue_amount',
        'autorule_complete_flag',
        'link_to_cust_trx_line_id',
        'tax_precedence',
        'tax_rate',
        'item_exception_rate_id',
        'tax_exemption_id',
        'autorule_duration_processed',
        'uom_code',
        'default_ussgl_transaction_code',
        'default_ussgl_trx_code_context',
        'interface_line_attribute10',
        'vat_tax_id',
        'item_context',
        'tax_exempt_flag',
        'tax_exempt_number',
        'tax_exempt_reason_code',
        'tax_vendor_return_code',
        'sales_tax_id',
        'location_segment_id',
        'movement_id',
        'global_attribute1',
        'global_attribute_category',
        'gross_unit_selling_price',
        'gross_extended_amount',
        'amount_includes_tax_flag',
        'taxable_amount',
        'warehouse_id',
        'translated_description',
        'extended_acctd_amount',
        'br_ref_customer_trx_id',
        'br_ref_payment_schedule_id',
        'br_adjustment_id',
        'mrc_extended_acctd_amount',
        'payment_set_id',
        'contract_line_id',
        'source_data_key1',
        'invoiced_line_acctg_level',
        'override_auto_accounting_flag',
        'ship_to_customer_id',
        'ship_to_address_id',
        'ship_to_site_use_id',
        'ship_to_contact_id',
        'historical_flag',
        'tax_line_id',
        'line_recoverable',
        'tax_recoverable',
        'tax_classification_code',
        'amount_due_remaining',
        'acctd_amount_due_remaining',
        'amount_due_original',
        'chrg_amount_remaining',
        'chrg_acctd_amount_remaining',
        'frt_adj_remaining',
        'frt_adj_acctd_remaining',
        'frt_ed_amount',
        'frt_ed_acctd_amount',
        'frt_uned_amount',
        'frt_uned_acctd_amount',
        'deferral_exclusion_flag',
        'acctd_amount_due_original',
        'rule_end_date',
        'payment_trxn_extension_id',
        'interest_line_id',
        'object_version_number',
        'memo_line_seq_id',
        'trx_business_category',
        'user_defined_fisc_class',
        'product_fisc_classification',
        'line_intended_use',
        'product_type',
        'product_category',
        'assessable_value',
        'source_document_line_number',
        'source_document_line_id',
        'fair_market_value_amount',
        'link_to_parentline_context',
        'link_to_parentline_attribute1',
        'link_to_parentline_attribute2',
        'tax_action',
        'requires_manual_scheduling',
        'tax_invoice_number',
        'final_discharge_location_id',
        'authorization_number',
        'auth_complete_flag',
        'ship_to_party_id',
        'ship_to_party_contact_id',
        'ship_to_party_site_use_id',
        'ship_to_party_address_id',
        'doc_line_id_int_1',
        'doc_line_id_char_1',
        'recurring_bill_flag',
        'recurring_bill_plan_id',
        'recurring_bill_plan_line_id',
        'bill_plan_line_id',
        'freight_charge',
        'insurance_charge',
        'packing_charge',
        'miscellaneous_charge',
        'commercial_discount'
    ];


    public function ItemMaster ()
    {
        return $this->hasOne(ItemMaster::class,'inventory_item_id','inventory_item_id');
    }

    public function tax_code()
    {
        return $this->hasOne(Tax::class,'tax_code','sales_tax_id')->where('type_tax_use','=','Sales');
    }

    public function acc()
    {
        return $this->hasOne(AccountCode::class, 'account_code','code_combinations');
    }

}
