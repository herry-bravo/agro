<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlLines extends Model
{
    use SoftDeletes;

    public $table = 'bm_gl_lines';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'effective_date',
    ];

    protected $fillable = [
        'id',
        'je_header_id',
        'je_line_num',
        'last_updated_by',
        'ledger_id',
        'code_combination_id',
        'period_name',
        'effective_date',
        'status',
        'created_by',
        'last_update_login',
        'entered_dr',
        'entered_cr',
        'accounted_dr',
        'accounted_cr',
        'description',
        'reference_1',
        'attribute1',
        'attribute_category',
        'attribute_category2',
        'invoice_date',
        'tax_code',
        'invoice_identifier',
        'invoice_amount',
        'stat_amount',
        'ignore_rate_flag',
        'subledger_doc_sequence_id',
        'attribute_category4',
        'subledger_doc_sequence_value',
        'global_attribute_number1',
        'gl_sl_link_table',
        'taxable_line_flag',
        'tax_type_code',
        'tax_code_id',
        'tax_rounding_rule_code',
        'amount_includes_tax_flag',
        'tax_document_identifier',
        'tax_document_date',
        'tax_customer_name',
        'tax_customer_reference',
        'tax_registration_number',
        'tax_line_flag',
        'tax_group_id',
        'line_type_code',
        'currency_code',
        'currency_conversion_date',
        'currency_conversion_type',
        'currency_conversion_rate',
        'orgnanization_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
    public function coa()
    {
        return $this->hasOne(AccountCode::class,'account_code','code_combination_id');
    }
    public function gl()
    {
        return $this->hasOne(GLHeader::class,'je_header_id','je_header_id');
    }
}
