<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmPosSessionsTable extends Migration
{
    public function up()
    {
        Schema::create('bm_pos_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('session_number', 20)->unique();
            $table->string('org_id', 50)->nullable();
            $table->integer('cashier_id');
            $table->decimal('opening_cash', 18, 2)->default(0);
            $table->decimal('closing_cash', 18, 2)->nullable();
            $table->string('status', 10)->default('open');
            $table->datetime('opened_at');
            $table->datetime('closed_at')->nullable();
            $table->text('notes')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('last_updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bm_pos_sessions');
    }
}
