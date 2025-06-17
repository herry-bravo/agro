<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    public function up()
    {
        Schema::create('bm_cust_site_uses_all', function (Blueprint $table) {
			$table->increments('id');
            $table->string('cust_party_code',12)->unique();
            $table->date('purpose_date');
            $table->string('party_name',50)->nullable();
            $table->string('address1',75)->nullable();
			$table->string('address2',100)->nullable();
			$table->string('address3',35)->nullable();
            $table->string('city',25)->nullable();
            $table->string('province',30)->nullable();
            $table->string('country',30)->nullable();
			$table->string('phone',15)->nullable();
            $table->string('email',30)->nullable();
            $table->string('postal_code',10)->nullable();
            $table->string('sales_tax_code',5)->nullable();
            $table->string('currency_code',3)->nullable();
            $table->integer('status')->nullable();
            $table->string('org_id',3)->nullable();
            $table->string('pic')->nullable();
            $table->string('title')->nullable();
            $table->string('attribute1')->default(0);
            $table->integer('attribute2')->default(0);
            $table->integer('attribute3')->default(0);
            $table->integer('attribute4')->default(0);
            $table->string('attribute5')->nullable();
            $table->string('attribute6')->nullable();
            $table->integer('attribute7')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
