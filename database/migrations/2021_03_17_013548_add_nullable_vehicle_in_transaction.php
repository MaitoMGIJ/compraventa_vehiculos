<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddNullableVehicleInTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //DB::statement('ALTER TABLE transactionS ALTER COLUMN vehicle_id DROP NOT NULL');
        //Schema::table('transaction', function (Blueprint $table) {
            //$table->bigInteger('vehicle_id')->nullable()->change();
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transaction', function (Blueprint $table) {
            //$table->bigInteger('vehicle_id')->change();
        });
    }
}
