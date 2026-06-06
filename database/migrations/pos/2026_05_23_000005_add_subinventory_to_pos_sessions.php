<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubinventoryCodeToPosSessionsTable extends Migration
{
    public function up()
    {
        Schema::table('bm_pos_sessions', function (Blueprint $table) {
            $table->string('subinventory_code', 30)->nullable()->after('org_id');
        });
    }

    public function down()
    {
        Schema::table('bm_pos_sessions', function (Blueprint $table) {
            $table->dropColumn('subinventory_code');
        });
    }
}
