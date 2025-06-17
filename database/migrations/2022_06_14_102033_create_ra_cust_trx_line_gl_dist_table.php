<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaCustTrxLineGlDistTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bm_ra_cust_trx_line_gl_dist', function (Blueprint $table) {
            $table->id();
            $table->float('cust_trx_line_gl_dist_id')->nullable();
$table->string('transfer_to_costing',1)->nullable();
$table->float('customer_trx_line_id')->nullable();
$table->float('code_combination_id')->nullable();
$table->float('set_of_books_id')->nullable();
$table->datetime('last_update_date')->nullable();
$table->string('last_updated_by',64)->nullable();
$table->datetime('creation_date')->nullable();
$table->string('created_by',64)->nullable();
$table->string('last_update_login',32)->nullable();
$table->float('percent')->nullable();
$table->float('amount')->nullable();
$table->DATE('gl_date')->nullable();
$table->DATE('gl_posted_date')->nullable();
$table->float('cust_trx_line_salesrep_id')->nullable();
$table->string('comments',240)->nullable();
$table->string('attribute_category',30)->nullable();
$table->string('attribute1',150)->nullable();
$table->string('attribute2',150)->nullable();
$table->float('request_id')->nullable();
$table->float('program_application_id')->nullable();
$table->float('program_id')->nullable();
$table->DATE('program_update_date')->nullable();
$table->string('concatenated_segments',240)->nullable();
$table->DATE('original_gl_date')->nullable();
$table->float('post_request_id')->nullable();
$table->float('posting_control_id')->nullable();
$table->string('account_class',20)->nullable();
$table->float('ra_post_loop_number')->nullable();
$table->float('customer_trx_id')->nullable();
$table->string('account_set_flag',1)->nullable();
$table->float('acctd_amount')->nullable();
$table->string('attribute11',150)->nullable();
$table->string('attribute12',150)->nullable();
$table->string('latest_rec_flag',1)->nullable();
$table->float('org_id')->nullable();
$table->float('collected_tax_ccid')->nullable();
$table->string('collected_tax_concat_seg',240)->nullable();
$table->float('revenue_adjustment_id')->nullable();
$table->string('rev_adj_class_temp',30)->nullable();
$table->string('rec_offset_flag',1)->nullable();
$table->float('event_id')->nullable();
$table->string('user_generated_flag',1)->nullable();
$table->float('object_version_number')->nullable();
$table->string('rounding_correction_flag',1)->nullable();

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
        Schema::dropIfExists('ra_cust_trx_line_gl_dist');
    }
}
