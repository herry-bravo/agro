<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class ArCustomerTrx extends Model
{
    use SoftDeletes;

    public $table = 'bm_ra_customer_trx_all';
    protected $dates = [
        'date_requested',
        'date_scheduled',
        'conversion_date',
        'created_at',
        'updated_at',
        // 'deleted_at',
    ];

    protected $fillable = [
        'id',
        'customer_trx_id',
        'src_invoicing_rule_id',
        'bill_template_name',
        'requires_manual_scheduling',
        'intercompany_flag',
        'last_update_date',
        'last_updated_by',
        'created_by',
        'last_update_login',
        'trx_number',
        'trx_date',
        'set_of_books_id',
        'bill_to_contact_id',
        'batch_id',
        'reason_code',
        'sold_to_customer_id',
        'sold_to_contact_id',
        'sold_to_site_use_id',
        'bill_to_customer_id',
        'bill_to_site_use_id',
        'ship_to_customer_id',
        'ship_to_contact_id',
        'ship_to_site_use_id',
        'shipment_id',
        'remit_to_address_id',
        'term_id',
        'term_due_date',
        'previous_customer_trx_id',
        'printing_original_date',
        'printing_last_printed',
        'printing_option',
        'printing_count',
        'printing_pending',
        'purchase_order',
        'purchase_order_revision',
        'purchase_order_date',
        'customer_reference',
        'customer_reference_date',
        'comments',
        'internal_notes',
        'exchange_rate_type',
        'exchange_date',
        'exchange_rate',
        'territory_id',
        'invoice_currency_code',
        'initial_customer_trx_id',
        'agreement_id',
        'end_date_commitment',
        'start_date_commitment',
        'last_printed_sequence_num',
        'attribute_category',
        'attribute1',
        'attribute2',
        'orig_system_batch_name',
        'post_request_id',
        'request_id',
        'program_application_id',
        'program_id',
        'program_update_date',
        'finance_charges',
        'complete_flag',
        'posting_control_id',
        'bill_to_address_id',
        'ra_post_loop_number',
        'ship_to_address_id',
        'credit_method_for_rules',
        'credit_method_for_installments',
        'receipt_method_id',
        'related_customer_trx_id',
        'invoicing_rule_id',
        'ship_via',
        'ship_date_actual',
        'waybill_number',
        'fob_point',
        'customer_bank_account_id',
        'interface_header_attribute1',
        'interface_header_attribute2',
        'interface_header_context',
        'default_ussgl_trx_code_context',
        'default_ussgl_transaction_code',
        'recurred_from_trx_number',
        'status_trx',
        'doc_sequence_id',
        'doc_sequence_value',
        'paying_customer_id',
        'paying_site_use_id',
        'default_tax_exempt_flag',
        'created_from',
        'org_id',
        'wh_update_date',
        'global_attribute1',
        'global_attribute_category',
        'edi_processed_flag',
        'edi_processed_status',
        'global_attribute_number1',
        'global_attribute_number3',
        'global_attribute_date2',
        'mrc_exchange_rate_type',
        'mrc_exchange_date',
        'mrc_exchange_rate',
        'payment_server_order_num',
        'approval_code',
        'address_verification_code',
        'old_trx_number',
        'br_amount',
        'br_unpaid_flag',
        'br_on_hold_flag',
        'drawee_id',
        'drawee_contact_id',
        'drawee_site_use_id',
        'remittance_bank_account_id',
        'override_remit_account_flag',
        'drawee_bank_account_id',
        'special_instructions',
        'remittance_batch_id',
        'prepayment_flag',
        'ct_reference',
        'contract_id',
        'bill_template_id',
        'reversed_cash_receipt_id',
        'cc_error_code',
        'cc_error_text',
        'cc_error_flag',
        'upgrade_method',
        'legal_entity_id',
        'remit_bank_acct_use_id',
        'payment_trxn_extension_id',
        'application_id',
        'payment_attributes',
        'billing_date',
        'interest_header_id',
        'late_charges_assessed',
        'cust_trx_type_seq_id',
        'batch_source_seq_id',
        'related_batch_source_seq_id',
        'primary_resource_salesrep_id',
        'object_version_number',
        'remit_to_address_seq_id',
        'default_taxation_country',
        'document_sub_type',
        'trx_business_category',
        'user_defined_fisc_class',
        'source_document_id',
        'source_document_type',
        'trx_class',
        'first_pty_reg_id',
        'third_pty_reg_id',
        'delivery_method_code',
        'print_request_id',
        'ship_to_party_id',
        'ship_to_party_contact_id',
        'ship_to_party_site_use_id',
        'ship_to_party_address_id',
        'sold_to_party_id',
        'document_type_id',
        'document_creation_date',
        'rev_rec_application',
        'billing_ext_request_id',
        'bill_plan_id',
        'bill_plan_period',
        'ready_for_xml_delivery_flag',
        'structured_payment_reference',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function dalivery()
    {
        return $this->hasOne(DeliveryHeader::class,'delivery_id','attribute1');
    }
    public function customer(){
        return $this->hasOne(Customer::class,'cust_party_code','bill_to_customer_id');
    }

    public function party_site(){
        return $this->hasOne(Site::class,'site_code','ship_to_customer_id');
    }


    public function currency()
    {
        return $this->hasOne(CurrencyGlobal::class, 'currency_code', 'invoice_currency_code');
    }

    public function arapp()
    {
        return $this->hasOne(ArReceivableApplications::class, 'receivable_application_id', 'customer_trx_id');
    }

    public function term()
    {
        return $this->hasOne(Terms::class, 'term_code', 'term_id');
    }
    public function tax()
    {
        return $this->hasOne(Tax::class, 'tax_code', 'tax_code');
    }
}
