<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatepartysiteTable extends Migration
{
    public function up()
    {
        Schema::create('bm_party_site', function (Blueprint $table) {
			$table->increments('id');
            $table->string('cust_party_code',12)->nullable();
			$table->string('site_code',12)->nullable();
            $table->string('site_type',14)->nullable();
            $table->string('address1',75)->nullable();
			$table->string('address2',100)->nullable();
			$table->string('address3',35)->nullable();
            $table->string('city',25)->nullable();
            $table->string('province',30)->nullable();
            $table->string('country',30)->nullable();
			$table->string('phone',15)->nullable();
            $table->string('email',30)->nullable();
            $table->string('postal_code',10)->nullable();
            $table->string('org_id',3)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
