<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUserIDToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
              $table->string('userID',12)->after('name')->nullable();
              $table->string('user_department',40)->after('email')->nullable();
              $table->integer('log_temp')->after('remember_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropDown('userID',12)->after('name')->nullable();
              $table->dropDown('user_department',40)->after('email')->nullable();
              $table->dropDown('log_temp')->after('remember_token')->nullable();
        });
    }
}
