<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBMGlLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_gl_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('je_header_id')->nullable();
            $table->integer('je_line_num')->nullable();
            $table->string('last_updated_by',64)->nullable();
            $table->integer('ledger_id')->nullable();
            $table->string('code_combination_id',15)->nullable();
            $table->string('period_name',15)->nullable();
            $table->date('effective_date')->nullable();
            $table->string('status',1)->nullable();
            $table->string('created_by',64)->nullable();
            $table->string('last_update_login',32)->nullable();
            $table->float('entered_dr')->nullable();
            $table->float('entered_cr')->nullable();
            $table->float('accounted_dr')->nullable();
            $table->float('accounted_cr')->nullable();
            $table->string('description',240)->nullable();
            $table->string('reference_1',240)->nullable();
            $table->string('attribute1',150)->nullable();
            $table->string('attribute_category',150)->nullable();
            $table->string('attribute_category2',150)->nullable();
            $table->date('invoice_date')->nullable();
            $table->string('tax_code',15)->nullable();
            $table->string('invoice_identifier',20)->nullable();
            $table->float('invoice_amount')->nullable();
            $table->float('stat_amount')->nullable();
            $table->string('ignore_rate_flag',1)->nullable();
            $table->integer('subledger_doc_sequence_id')->nullable();
            $table->string('attribute_category4',150)->nullable();
            $table->integer('subledger_doc_sequence_value')->nullable();
            $table->float('global_attribute_number1')->nullable();
            $table->string('gl_sl_link_table',30)->nullable();
            $table->string('taxable_line_flag',1)->nullable();
            $table->string('tax_type_code',1)->nullable();
            $table->string('tax_code_id',5)->nullable();
            $table->string('tax_rounding_rule_code',1)->nullable();
            $table->string('amount_includes_tax_flag',1)->nullable();
            $table->string('tax_document_identifier',50)->nullable();
            $table->date('tax_document_date')->nullable();
            $table->string('tax_customer_name',240)->nullable();
            $table->string('tax_customer_reference',240)->nullable();
            $table->string('tax_registration_number',50)->nullable();
            $table->string('tax_line_flag',1)->nullable();
            $table->string('tax_group_id',5)->nullable();
            $table->string('line_type_code',20)->nullable();
            $table->string('currency_code',15)->nullable();
            $table->date('currency_conversion_date')->nullable();
            $table->string('currency_conversion_type',30)->nullable();
            $table->float('currency_conversion_rate')->nullable();
            $table->string('orgnanization_id',3)->nullable();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_b_m_gl_lines');
    }
}
