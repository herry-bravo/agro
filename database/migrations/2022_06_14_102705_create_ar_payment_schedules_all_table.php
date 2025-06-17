<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArPaymentSchedulesAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_ar_payment_schedules_all', function (Blueprint $table) {
            $table->id();
            $table->float('payment_schedule_id')->nullable();
$table->string('module_id',32)->nullable();
$table->float('amount_on_account')->nullable();
$table->float('amount_other_account')->nullable();
$table->float('staged_dunning_level')->nullable();
$table->DATE('dunning_level_override_date')->nullable();
$table->datetime('last_update_date')->nullable();
$table->string('last_updated_by',64)->nullable();
$table->datetime('creation_date')->nullable();
$table->string('created_by',64)->nullable();
$table->string('last_update_login',32)->nullable();
$table->DATE('due_date')->nullable();
$table->float('amount_due_original')->nullable();
$table->float('amount_due_remaining')->nullable();
$table->float('number_of_due_dates')->nullable();
$table->string('status',30)->nullable();
$table->string('invoice_currency_code',15)->nullable();
$table->string('class',20)->nullable();
$table->float('customer_id')->nullable();
$table->float('customer_site_use_id')->nullable();
$table->float('customer_trx_id')->nullable();
$table->float('cash_receipt_id')->nullable();
$table->float('associated_cash_receipt_id')->nullable();
$table->float('term_id')->nullable();
$table->float('terms_sequence_number')->nullable();
$table->DATE('gl_date_closed')->nullable();
$table->DATE('actual_date_closed')->nullable();
$table->DATE('discount_date')->nullable();
$table->float('amount_line_items_original')->nullable();
$table->float('amount_line_items_remaining')->nullable();
$table->float('amount_applied')->nullable();
$table->float('amount_adjusted')->nullable();
$table->float('amount_in_dispute')->nullable();
$table->float('amount_credited')->nullable();
$table->float('receivables_charges_charged')->nullable();
$table->float('receivables_charges_remaining')->nullable();
$table->float('freight_original')->nullable();
$table->float('freight_remaining')->nullable();
$table->float('tax_original')->nullable();
$table->float('tax_remaining')->nullable();
$table->float('discount_original')->nullable();
$table->float('discount_remaining')->nullable();
$table->float('discount_taken_earned')->nullable();
$table->float('discount_taken_unearned')->nullable();
$table->string('in_collection',1)->nullable();
$table->float('cash_applied_id_last')->nullable();
$table->DATE('cash_applied_date_last')->nullable();
$table->float('cash_applied_amount_last')->nullable();
$table->string('cash_applied_status_last',30)->nullable();
$table->DATE('cash_gl_date_last')->nullable();
$table->float('cash_receipt_id_last')->nullable();
$table->DATE('cash_receipt_date_last')->nullable();
$table->float('cash_receipt_amount_last')->nullable();
$table->string('cash_receipt_status_last',30)->nullable();
$table->string('exchange_rate_type',30)->nullable();
$table->DATE('exchange_date')->nullable();
$table->float('exchange_rate')->nullable();
$table->float('adjustment_id_last')->nullable();
$table->DATE('adjustment_date_last')->nullable();
$table->DATE('adjustment_gl_date_last')->nullable();
$table->float('adjustment_amount_last')->nullable();
$table->DATE('follow_up_date_last')->nullable();
$table->string('follow_up_code_last',30)->nullable();
$table->DATE('promise_date_last')->nullable();
$table->float('promise_amount_last')->nullable();
$table->float('collector_last')->nullable();
$table->DATE('call_date_last')->nullable();
$table->string('trx_number',30)->nullable();
$table->DATE('trx_date')->nullable();
$table->string('attribute_category',30)->nullable();
$table->string('attribute1',150)->nullable();
$table->float('reversed_cash_receipt_id')->nullable();
$table->float('amount_adjusted_pending')->nullable();
$table->DATE('gl_date')->nullable();
$table->float('acctd_amount_due_remaining')->nullable();
$table->float('program_application_id')->nullable();
$table->float('program_id')->nullable();
$table->DATE('program_update_date')->nullable();
$table->string('receipt_confirmed_flag',1)->nullable();
$table->float('request_id')->nullable();
$table->float('selected_for_receipt_batch_id')->nullable();
$table->DATE('last_charge_date')->nullable();
$table->DATE('second_last_charge_date')->nullable();
$table->DATE('dispute_date')->nullable();
$table->float('org_id')->nullable();
$table->string('global_attribute1',150)->nullable();
$table->string('global_attribute2',150)->nullable();
$table->string('global_attribute_category',30)->nullable();
$table->float('cons_inv_id')->nullable();
$table->float('cons_inv_id_rev')->nullable();
$table->string('exclude_from_dunning_flag',1)->nullable();
$table->float('br_amount_assigned')->nullable();
$table->string('reserved_type',30)->nullable();
$table->float('reserved_value')->nullable();
$table->string('active_claim_flag',1)->nullable();
$table->string('exclude_from_cons_bill_flag',1)->nullable();
$table->string('payment_approval',30)->nullable();
$table->float('object_version_number')->nullable();
$table->float('cust_trx_type_seq_id')->nullable();
$table->float('global_attribute_number1')->nullable();
$table->string('del_contact_email_address',1000)->nullable();
$table->float('print_request_id')->nullable();
$table->string('seed_data_source',512)->nullable();

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
        Schema::dropIfExists('ar_payment_schedules_all');
    }
}
