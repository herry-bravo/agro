<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{


    public function up()
    {
        Schema::create('bm_ap_invoice_payments_id', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id');
            $table->date('accounting_date')->nullable();
            $table->float('amount')->nullable();
            $table->float('invoice_payment_id')->nullable();
            $table->string('last_updated_by',64)->nullable();
            $table->datetime('last_update_date')->nullable();
            $table->string('payment_num',10)->nullable();
            $table->string('period_name',15)->nullable();
            $table->string('posted_flag',1)->nullable();
            $table->float('set_of_books_id')->nullable();
            $table->float('accts_pay_code_combination_id')->nullable();
            $table->float('asset_code_combination_id')->nullable();
            $table->string('created_by',64)->nullable();
            $table->string('last_update_login',32)->nullable();
            $table->string('bank_account_num',30)->nullable();
            $table->string('bank_account_type',25)->nullable();
            $table->string('bank_num',25)->nullable();
            $table->float('discount_lost')->nullable();
            $table->float('invoice_base_amount')->nullable();
            $table->float('payment_base_amount')->nullable();
            $table->string('attribute1',75)->nullable();
            $table->string('attribute_category',75)->nullable();
            $table->string('invoice_payment_type',25)->nullable();
            $table->string('global_attribute_category',75)->nullable();
            $table->string('global_attribute1',75)->nullable();
            $table->float('accounting_event_id')->nullable();
            $table->float('invoicing_party_id')->nullable();
            $table->float('invoicing_party_site_id')->nullable();
            $table->float('invoicing_vendor_site_id')->nullable();
            $table->float('exchange_rate')->nullable();
            $table->date('exchange_date')->nullable();
            $table->string('invoice_currency_code',15)->nullable();
            $table->string('payment_currency_code',15)->nullable();
            $table->float('amount_inv_curr')->nullable();
            $table->float('discount_lost_inv_curr')->nullable();
            $table->string('remit_to_supplier_name',150)->nullable();
            $table->float('remit_to_supplier_id')->nullable();
            $table->string('remit_to_address_name',150)->nullable();
            $table->float('remit_to_address_id')->nullable();
            $table->date('global_attribute_date1')->nullable();
            $table->float('org_id')->nullable();
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
        Schema::dropIfExists('pahment');
    }
}
