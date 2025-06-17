<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesupplierTable extends Migration
{
    public function up()
    {
        Schema::create('bm_vendor_header', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vendor_id')->unique();
            $table->string('vendor_name',150)->nullable();
            $table->string('vendor_site',15)->nullable();
            $table->string('address1',75)->nullable();
            $table->string('address2',50)->nullable();
            $table->string('city',50)->nullable();
			$table->string('province',50)->nullable();
			$table->string('country',100)->nullable();
            $table->string('currency',3)->nullable();
            $table->string('phone',14)->nullable();
            $table->string('email',50)->nullable();
			$table->string('tax_code',10)->nullable();
            $table->string('bank_number',20)->nullable();
            $table->string('terms',10)->nullable();
            $table->integer('status')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}