<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArAdjustmentsAllTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_ar_adjustments_all', function (Blueprint $table) {
            $table->id();
            $table->float('adjustment_id')->nullable();
$table->string('last_updated_by',64)->nullable();
$table->datetime('last_update_date')->nullable();
$table->string('last_update_login',32)->nullable();
$table->string('created_by',64)->nullable();
$table->datetime('creation_date')->nullable();
$table->float('amount')->nullable();
$table->DATE('apply_date')->nullable();
$table->DATE('gl_date')->nullable();
$table->float('set_of_books_id')->nullable();
$table->float('code_combination_id')->nullable();
$table->string('type',15)->nullable();
$table->string('adjustment_type',3)->nullable();
$table->string('status',30)->nullable();
$table->float('line_adjusted')->nullable();
$table->float('line_nonrecoverable')->nullable();
$table->float('freight_adjusted')->nullable();
$table->float('tax_adjusted')->nullable();
$table->float('tax_nonrecoverable')->nullable();
$table->float('receivables_charges_adjusted')->nullable();
$table->float('associated_cash_receipt_id')->nullable();
$table->float('chargeback_customer_trx_id')->nullable();
$table->float('batch_id')->nullable();
$table->float('customer_trx_id')->nullable();
$table->float('customer_trx_line_id')->nullable();
$table->float('subsequent_trx_id')->nullable();
$table->float('payment_schedule_id')->nullable();
$table->float('receivables_trx_id')->nullable();
$table->float('distribution_set_id')->nullable();
$table->DATE('gl_posted_date')->nullable();
$table->string('comments',150)->nullable();
$table->string('automatically_generated',1)->nullable();
$table->string('created_from',30)->nullable();
$table->string('reason_code',30)->nullable();
$table->string('postable',1)->nullable();
$table->string('approved_by',64)->nullable();
$table->string('attribute_category',30)->nullable();
$table->string('attribute1',150)->nullable();
$table->string('attribute2',150)->nullable();
$table->string('attribute3',150)->nullable();
$table->string('attribute4',150)->nullable();
$table->string('attribute5',150)->nullable();
$table->string('attribute6',150)->nullable();
$table->string('attribute7',150)->nullable();
$table->string('attribute8',150)->nullable();
$table->string('attribute9',150)->nullable();
$table->string('attribute10',150)->nullable();
$table->float('posting_control_id')->nullable();
$table->float('acctd_amount')->nullable();
$table->string('attribute11',150)->nullable();
$table->string('attribute12',150)->nullable();
$table->string('attribute13',150)->nullable();
$table->string('attribute14',150)->nullable();
$table->string('attribute15',150)->nullable();
$table->float('program_application_id')->nullable();
$table->float('program_id')->nullable();
$table->DATE('program_update_date')->nullable();
$table->float('request_id')->nullable();
$table->string('adjustment_number',20)->nullable();
$table->float('org_id')->nullable();
$table->string('ussgl_transaction_code',30)->nullable();
$table->string('ussgl_transaction_code_context',30)->nullable();
$table->float('doc_sequence_value')->nullable();
$table->float('doc_sequence_id')->nullable();
$table->float('associated_application_id')->nullable();
$table->float('cons_inv_id')->nullable();
$table->string('mrc_gl_posted_date',150)->nullable();
$table->string('mrc_posting_control_id',150)->nullable();
$table->string('mrc_acctd_amount',150)->nullable();
$table->string('adj_tax_acct_rule',3)->nullable();
$table->string('global_attribute_category',150)->nullable();
$table->string('global_attribute1',150)->nullable();
$table->string('global_attribute2',150)->nullable();
$table->float('link_to_trx_hist_id')->nullable();
$table->float('event_id')->nullable();
$table->string('upgrade_method',30)->nullable();
$table->string('ax_accounted_flag',1)->nullable();
$table->float('interest_header_id')->nullable();
$table->float('interest_line_id')->nullable();
$table->float('object_version_number')->nullable();

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
        Schema::dropIfExists('ar_adjustments_all');
    }
}
