<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArReceivableApplicationsAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_ar_receivable_applications_all', function (Blueprint $table) {
            $table->id();
            $table->float('receivable_application_id')->nullable();
$table->string('exception_reason_code',30)->nullable();
$table->string('last_updated_by',64)->nullable();
$table->datetime('last_update_date')->nullable();
$table->string('created_by',64)->nullable();
$table->datetime('creation_date')->nullable();
$table->float('amount_applied')->nullable();
$table->float('amount_applied_from')->nullable();
$table->float('trans_to_receipt_rate')->nullable();
$table->DATE('gl_date')->nullable();
$table->float('code_combination_id')->nullable();
$table->float('set_of_books_id')->nullable();
$table->string('display',1)->nullable();
$table->DATE('apply_date')->nullable();
$table->string('application_type',20)->nullable();
$table->string('status',30)->nullable();
$table->float('payment_schedule_id')->nullable();
$table->string('last_update_login',32)->nullable();
$table->float('cash_receipt_id')->nullable();
$table->float('applied_customer_trx_id')->nullable();
$table->float('applied_customer_trx_line_id')->nullable();
$table->float('applied_payment_schedule_id')->nullable();
$table->float('customer_trx_id')->nullable();
$table->float('line_applied')->nullable();
$table->float('tax_applied')->nullable();
$table->float('freight_applied')->nullable();
$table->float('receivables_charges_applied')->nullable();
$table->float('earned_discount_taken')->nullable();
$table->float('unearned_discount_taken')->nullable();
$table->float('days_late')->nullable();
$table->string('application_rule',30)->nullable();
$table->DATE('gl_posted_date')->nullable();
$table->string('comments',240)->nullable();
$table->string('attribute_category',30)->nullable();
$table->string('attribute1',150)->nullable();
$table->string('attribute2',150)->nullable();
$table->string('postable',1)->nullable();
$table->float('posting_control_id')->nullable();
$table->float('acctd_amount_applied_from')->nullable();
$table->float('acctd_amount_applied_to')->nullable();
$table->float('acctd_earned_discount_taken')->nullable();
$table->string('confirmed_flag',1)->nullable();
$table->float('program_application_id')->nullable();
$table->float('program_id')->nullable();
$table->DATE('program_update_date')->nullable();
$table->float('request_id')->nullable();
$table->string('ussgl_transaction_code',30)->nullable();
$table->string('ussgl_transaction_code_context',30)->nullable();
$table->float('earned_discount_ccid')->nullable();
$table->float('unearned_discount_ccid')->nullable();
$table->float('acctd_unearned_discount_taken')->nullable();
$table->DATE('reversal_gl_date')->nullable();
$table->float('cash_receipt_history_id')->nullable();
$table->float('org_id')->nullable();
$table->string('tax_code',50)->nullable();
$table->string('global_attribute1',150)->nullable();
$table->string('global_attribute2',150)->nullable();
$table->string('global_attribute3',150)->nullable();
$table->string('global_attribute_category',30)->nullable();
$table->float('cons_inv_id')->nullable();
$table->float('cons_inv_id_to')->nullable();
$table->float('rule_set_id')->nullable();
$table->float('line_ediscounted')->nullable();
$table->float('tax_ediscounted')->nullable();
$table->float('freight_ediscounted')->nullable();
$table->float('charges_ediscounted')->nullable();
$table->float('line_uediscounted')->nullable();
$table->float('tax_uediscounted')->nullable();
$table->float('freight_uediscounted')->nullable();
$table->float('charges_uediscounted')->nullable();
$table->float('receivables_trx_id')->nullable();
$table->float('on_account_customer')->nullable();
$table->string('edisc_tax_acct_rule',3)->nullable();
$table->string('unedisc_tax_acct_rule',3)->nullable();
$table->float('link_to_trx_hist_id')->nullable();
$table->float('link_to_customer_trx_id')->nullable();
$table->string('application_ref_type',30)->nullable();
$table->float('application_ref_id')->nullable();
$table->string('application_ref_num',30)->nullable();
$table->float('chargeback_customer_trx_id')->nullable();
$table->float('secondary_application_ref_id')->nullable();
$table->float('payment_set_id')->nullable();
$table->string('application_ref_reason',30)->nullable();
$table->string('customer_reference',100)->nullable();
$table->string('customer_reason',30)->nullable();
$table->float('applied_rec_app_id')->nullable();
$table->string('secondary_application_ref_type',30)->nullable();
$table->string('secondary_application_ref_num',30)->nullable();
$table->float('event_id')->nullable();
$table->string('upgrade_method',30)->nullable();
$table->float('object_version_number')->nullable();
$table->float('global_attribute_number1')->nullable();

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
        Schema::dropIfExists('ar_receivable_applications_all');
    }
}
