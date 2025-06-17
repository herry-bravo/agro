<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeFgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_inv_attribute_fg', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('je_header_id');
            $table->string('last_updated_by',64)->nullable();
            $table->float('ledger_id')->nullable();
            $table->string('je_category',25)->nullable();
            $table->string('je_source',25)->nullable();
            $table->string('period_name',15)->nullable();
            $table->string('name',100)->nullable();
            $table->string('currency_code',15)->nullable();
            $table->string('status',1)->nullable();
            $table->string('accrual_rev_flag',1)->nullable();
            $table->string('actual_flag',1)->nullable();
            $table->string('conversion_flag',1)->nullable();
            $table->date('default_effective_date')->nullable();
            $table->string('created_by',64)->nullable();
            $table->float('je_batch_id')->nullable();
            $table->float('from_recurring_header_id')->nullable();
            $table->integer('posted')->nullable();
            $table->date('posted_date')->nullable();
            $table->date('accrual_rev_effective_date')->nullable();
            $table->string('accrual_rev_period_name',15)->nullable();
            $table->string('accrual_rev_status',1)->nullable();
            $table->float('accrual_rev_je_header_id')->nullable();
            $table->string('description',240)->nullable();
            $table->float('control_total')->nullable();
            $table->float('running_total_dr')->nullable();
            $table->float('running_total_cr')->nullable();
            $table->float('running_total_accounted_dr')->nullable();
            $table->float('running_total_accounted_cr')->nullable();
            $table->float('currency_conversion_rate')->nullable();
            $table->string('currency_conversion_type',30)->nullable();
            $table->date('currency_conversion_date')->nullable();
            $table->string('external_reference',80)->nullable();
            $table->string('party_name',150)->nullable();
            $table->string('attribute1',150)->nullable();
            $table->string('attribute_category',150)->nullable();
            $table->string('tax_status_code',1)->nullable();
            $table->float('parent_je_header_id')->nullable();
            $table->float('reversed_je_header_id')->nullable();
            $table->string('originating_bal_seg_value',25)->nullable();
            $table->float('intercompany_mode')->nullable();
            $table->string('dr_bal_seg_value',25)->nullable();
            $table->string('cr_bal_seg_value',25)->nullable();
            $table->float('local_doc_sequence_id')->nullable();
            $table->float('local_doc_sequence_value')->nullable();
            $table->string('display_alc_journal_flag',1)->nullable();
            $table->string('je_from_sla_flag',1)->nullable();
            $table->float('posting_acct_seq_version_id')->nullable();
            $table->float('posting_acct_seq_assign_id')->nullable();
            $table->float('posting_acct_seq_value')->nullable();
            $table->float('close_acct_seq_version_id')->nullable();
            $table->float('close_acct_seq_assign_id')->nullable();
            $table->float('close_acct_seq_value')->nullable();
            $table->float('tax_legal_entity_id')->nullable();
            $table->string('post_multi_currency_flag',1)->nullable();
            $table->string('post_currency_code',15)->nullable();
            $table->string('organization_id',3)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bm_inv_attribute_fg');
    }
}
